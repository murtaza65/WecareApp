<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\UpdateChatRequest;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $apiKey;
    // protected $model = 'gpt2'; // Change this to another model if needed
    // protected $model = 'facebook/blenderbot-400M-distill'; // Change this to another model if needed
    protected $model = 'flax-community/t5-recipe-generation';

    public function __construct()
    {
        // $this->apiKey = env('OPENAI_API_KEY');
        $this->apiKey = env('HUGGINGFACE_API_KEY');
    }

    public function index()
    {
        //

        return view('chat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChatRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chat $chat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChatRequest $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chat $chat)
    {
        //
    }

    public function sendMessage(Request $request)
    {
        $userMessage = $request->input('message');

        // Here, you can call any logic for AI, or a simple pre-defined response
        $botResponse = "Hello, How can i help you?";

        // Return a JSON response with the bot's message
        return response()->json(['message' => $botResponse]);
    }

    public function botChat(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model'       => 'gpt-3.5-turbo', // Use GPT-4 if available
            'messages'    => [
                ['role' => 'system', 'content' => 'You are an AI assistant.'],
                ['role' => 'user', 'content' => $request->message],
            ],
            'temperature' => 0.7,
            'max_tokens'  => 100,
        ]);

        $botResponse = $response->json()['choices'][0]['message']['content'] ?? 'No response';
        return response()->json(['message' => $botResponse]);
    }

    public function getAIResponse(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
        ])->post("https://api-inference.huggingface.co/models/" . $this->model, [
            'inputs'     => $request->message,
            'parameters' => ['max_length' => 1000],
        ]);
        $botResponse = $response->json()[0]['generated_text'] ?? 'No response';

        return response()->json(['message' => $botResponse]);
    }

    // public function getAIResponse(Request $request)
    // {
    //     $response = Http::withHeaders([
    //         'Authorization' => 'Bearer ' . $this->apiKey,
    //         'Content-Type'  => 'application/json',
    //     ])->post("https://api-inference.huggingface.co/models/" . $this->model, [
    //         'inputs'     => $request->message,
    //         'parameters' => ['max_length' => 100],
    //     ]);

    //     if ($response->failed()) {
    //         return response()->json(['message' => 'Hugging Face API error'], 500);
    //     }

    //     return response()->json(['token' => $response->json()['token']]);
    // }

    public function recipeApi1(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
        ])
            ->timeout(60)
            ->post("https://api-inference.huggingface.co/models/flax-community/t5-recipe-generation", [
                'inputs'     => "Generate a recipe using " . $request->message,
                'parameters' => ['max_length' => 200],
            ]);

        $botResponse = $response->json()[0]['generated_text'] ?? 'No recipe found.';

        return response()->json(['message' => $botResponse]);

    }

    public function recipeApi2(Request $request)
    {
        $userInput = $request->message;

        // Ensure the input is not empty
        if (empty($userInput)) {
            return response()->json(['message' => 'Please provide some ingredients.']);
        }

        // Send request to Hugging Face model
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
        ])
            ->timeout(60) // Prevent timeout errors
            ->post("https://api-inference.huggingface.co/models/flax-community/t5-recipe-generation", [
                'inputs'     => "Give a recipe based on: " . $userInput,
                'parameters' => ['max_length' => 300],
            ]);

        // Handle response
        if ($response->failed()) {
            return response()->json(['message' => 'Sorry, I couldn’t generate a recipe. Try again!']);
        }

        $botResponse = $response->json()[0]['generated_text'] ?? 'No recipe found.';

        return response()->json(['message' => $botResponse]);
    }

    public function getGeminiAIResponse2(Request $request)
    {
        $userInput = $request->message;

        if (empty($userInput)) {
            return response()->json(['message' => 'Please provide some ingredients.']);
        }

        $apiKey = env('GEMINI_API_KEY');
        // $url    = "https://generativelanguage.googleapis.com/v1beta/models/gemini-pro:generateText?key=$apiKey";
        $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash:generateContent?key=" . $apiKey;

        $response = Http::post($url, [
            'contents' => [
                'parts' => [
                    "Suggest a detailed recipe using these ingredients: $userInput. Include ingredients and step-by-step instructions."],
            ],
        ]);

        if ($response->failed()) {
            return response()->json(['message' => $response]);
        }

        $botResponse = $response->json()['candidates'][0]['output'] ?? 'No recipe found.';

        return response()->json(['message' => $botResponse]);
    }

    public function getGeminiAIResponse(Request $request)
    {
        $userInput = $request->message;

        if (empty($userInput)) {
            return response()->json(['message' => 'Please provide some ingredients.']);
        }

        $apiKey = env('GEMINI_API_KEY');
        $url    = "https://generativelanguage.googleapis.com/v1beta/models/gemini-1.0-pro:generateContent?key=$apiKey";

        $payload = [
            "contents"         => [
                [
                    "role"  => "user",
                    "parts" => [
                        ["text" => "Generate a detailed food recipe using these ingredients: $userInput."],
                    ],
                ],
            ],
            "generationConfig" => [
                "temperature"     => 0.7,
                "topK"            => 40,
                "topP"            => 0.95,
                "maxOutputTokens" => 1000,
                // "responseMimeType" => "application/json",
            ],
        ];

        $response = Http::post($url, $payload);

        if ($response->failed()) {
            // return response()->json(['message' => 'AI request failed. Try again later.']);
            return $response;

        }

        $responseData = $response->json();
        $botResponse  = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'No recipe found.';

        return response()->json(['message' => $botResponse]);
    }

}
