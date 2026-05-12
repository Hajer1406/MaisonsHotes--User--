<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function ask(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1200',
        ]);

        $apiKey = env('GROQ_API_KEY');
        if (!$apiKey) {
            return response()->json(['error' => 'Clé Groq manquante. Configurez GROQ_API_KEY dans .env.'], 500);
        }

        // Récupérer l'historique de la session (max 10 derniers messages)
        $history = session('chatbot_history', []);
        
        // Ajouter le message actuel de l'utilisateur
        $history[] = ['role' => 'user', 'content' => $request->message];

        // Construire les messages pour l'API (System + History)
        $apiMessages = [
            [
                'role' => 'system',
                'content' => "You are a professional assistant for a Tunisian maison d'hôtes website. Answer politely in French, focus on pricing, location, chambres, réservation and local hospitality. Use Markdown formatting (bold, bullet points) to make your answers clear and professional."
            ]
        ];
        $apiMessages = array_merge($apiMessages, $history);

        $response = Http::withToken($apiKey)
            ->timeout(30)
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model' => 'llama3-8b-8192',
                'messages' => $apiMessages,
                'temperature' => 0.7,
                'max_tokens' => 500,
            ]);

        if ($response->failed()) {
            // Fallback en cas d'erreur de clé ou d'API pour la soutenance / démo
            $msg = strtolower($request->message);
            $answer = "Je suis désolé, le service d'intelligence artificielle est temporairement indisponible. ";

            $hasPrix = str_contains($msg, 'prix') || str_contains($msg, 'tarif') || str_contains($msg, 'combien');
            $hasDest = str_contains($msg, 'hammamet') || str_contains($msg, 'djerba') || str_contains($msg, 'sidi bou said') || str_contains($msg, 'tunis') || str_contains($msg, 'tozeur') || str_contains($msg, 'sousse');
            $hasChambre = str_contains($msg, 'chambre') || str_contains($msg, 'lit') || str_contains($msg, 'suite') || str_contains($msg, 'double') || str_contains($msg, 'individuelle');
            $hasSuite = str_contains($msg, 'suite');
            
            if ($hasPrix && $hasSuite) {
                $answer = "Le tarif pour une **suite luxueuse** est généralement compris entre **250 TND et 450 TND** par nuit, selon la destination et la saison. Ce tarif inclut toujours un délicieux petit-déjeuner traditionnel !";
            } elseif ($hasPrix && $hasChambre) {
                $answer = "Pour nos chambres, comptez environ **150 à 250 TND** pour une chambre individuelle ou double, et jusqu'à **450 TND** pour une suite. Le petit-déjeuner est inclus. Avez-vous une préférence de région ?";
            } elseif ($hasPrix && $hasDest) {
                $answer = "**Pour cette magnifique destination**, nos maisons d'hôtes proposent des tarifs allant de **180 TND** à **350 TND** par nuit en moyenne, avec un délicieux petit-déjeuner traditionnel inclus. Je vous invite à faire une recherche précise pour voir les disponibilités !";
            } elseif ($hasPrix) {
                $answer = "Les prix de nos maisons varient généralement entre **150 TND** et **450 TND** par nuit, selon le type de chambre (individuelle, double ou suite) et la saison. Avez-vous une destination précise en tête ?";
            } elseif (str_contains($msg, 'hammamet')) {
                $answer = "Excellente destination ! **Hammamet** est réputée pour ses magnifiques plages et sa médina.\n\nNous avons plusieurs maisons d'hôtes superbes dans cette région. Vous pouvez les découvrir en filtrant par 'Hammamet' sur la page Maisons.";
            } elseif ($hasDest) {
                $answer = "C'est un choix fantastique. Nous avons des maisons d'hôtes authentiques et pleines de charme dans cette région. Je vous invite à utiliser notre barre de recherche pour voir nos disponibilités !";
            } elseif (str_contains($msg, 'bonjour') || str_contains($msg, 'salut') || str_contains($msg, 'coucou')) {
                $answer = "Bonjour ! Comment puis-je vous aider à planifier votre séjour en Tunisie ?";
            } elseif ($hasChambre) {
                $answer = "Nous proposons :\n- Des chambres individuelles\n- Des chambres doubles\n- Des suites luxueuses\n\nToutes nos chambres sont équipées du confort moderne tout en gardant une touche traditionnelle tunisienne.";
            } elseif (str_contains($msg, 'réserver') || str_contains($msg, 'reservation') || str_contains($msg, 'reserver')) {
                $answer = "Pour réserver :\n1. Naviguez vers la page **Maisons**\n2. Choisissez celle qui vous plaît\n3. Cliquez sur **Réserver** pour la chambre de votre choix.\n\nLe paiement en ligne sécurisé confirmera votre réservation.";
            } elseif (str_contains($msg, 'merci')) {
                $answer = "Je vous en prie ! C'est toujours un plaisir. N'hésitez pas si vous avez besoin d'autre chose.";
            } else {
                $answer = "C'est noté ! Bien que mon intelligence artificielle soit temporairement limitée aujourd'hui, vous trouverez toutes les informations nécessaires dans la section **Maisons** ou en utilisant les filtres de recherche. Puis-je vous aider avec autre chose ?";
            }

            // Ne pas sauvegarder l'historique en cas d'échec pour ne pas biaiser le vrai LLM si la clé est remise
            return response()->json(['answer' => $answer]);
        }

        $answer = data_get($response->json(), 'choices.0.message.content', 'Désolé, je n’ai pas pu répondre pour le moment.');

        // Sauvegarder la réponse de l'assistant dans l'historique
        $history[] = ['role' => 'assistant', 'content' => trim($answer)];
        
        // Garder uniquement les 10 derniers messages (5 échanges)
        if (count($history) > 10) {
            $history = array_slice($history, -10);
        }
        
        session(['chatbot_history' => $history]);

        return response()->json(['answer' => trim($answer)]);
    }
}
