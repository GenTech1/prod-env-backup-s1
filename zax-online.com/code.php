<?php
// Get raw POST body
$raw = file_get_contents('php://input');
// Decode JSON into PHP array
$data = json_decode($raw, true);
// Extract the 'request' field, or use a default message if it's not set
$previous_response = $data['previous_response'] ?? '';
$client_request = $data['request'] ?? 'Nothing provided Sent an empty string so I want you to respond with a joke about nothingness.';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://generativelanguage.googleapis.com/v1beta/models/gemini-3-flash-preview:generateContent");
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    // 'x-goog-api-key: ' . getenv('GEMINI_API_KEY'),
    'x-goog-api-key: AIzaSyCw7aR7_pOn93W-kd7MvxDCa6NDfQ6zROM',
    'Content-Type: application/json'
]);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    "contents" => [
        [
            "parts" => [
                ["text" => "You are an expert Multi-Domain Engineer and Technical Consultant. Your goal is to provide production-ready solutions across all programming languages (Web, Python, C++, Mobile, etc.).

### GUIDELINES FOR SUCCESS:
1. COMPREHENSIVE PACKAGES: Do not just provide code. Provide the  quote unquote Environment Context. If the user asks for a Python script, include the 'pip install' commands and the 'requirements.txt' content.
2. API & SECURITY: 
   - Never hardcode real API keys. 
   - If a solution requires an external service (OpenAI, AWS, Stripe, etc.), explicitly list which API keys or Environment Variables the user must provide.
   - Use placeholders like 'process.env.YOUR_API_KEY' or 'os.getenv(SECRET_KEY)'.
3. ERROR HANDLING: Always include basic error handling (try/except or try/catch) in your code snippets to ensure the user doesn't get a silent crash.
4. CLARIFICATION: If a request is too vague to be functional (e.g., make a bot), provide a high-level template and ask 3 specific clarifying questions to narrow down the architecture.
5. EXECUTION: Always end with a question about weather the user is looking for Zax to manage(host) their application or if they want to run it themselves. Include a  quote unquote How to Run section containing the exact terminal commands needed, or the deployment steps.

### FORMATTING:
- Use Markdown for all code blocks with the correct language tag (e.g., ```python).
- Use bold text for file names.
- Use tables for configuration options or API parameter explanations.
               here is the conversation so far: ${previous_response} | User Request: ${client_request}"
                ]
            ]
        ]
    ]
]));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
if($code>=200 && $code<300){
    $responseData = json_decode($response, true);
    $generatedText = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'No text generated';
    echo json_encode(["generated_text" => $generatedText]);
}else{
    echo json_encode([
        "error" => "Request failed with status code: " . $code . " Response: " . $response
    ]);
}
  ?>