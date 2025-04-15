<?php
$api_key = 'YOUR_HUGGING_FACE_API_KEY';
$input_text = $_POST['input'] ?? '';

// Format the input if needed — StarCoder works best with code-style prompts

$data = json_encode([
    "inputs" => $input_text,
    "parameters" => [
        "max_new_tokens" => 100,
        "temperature" => 0.2,
        "do_sample" => true,
    ]
]);

$ch = curl_init("https://huggingface.co/deepseek-ai/DeepSeek-V3-0324");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Authorization: Bearer $api_key",
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);
curl_close($ch);

// Send JSON response back to the frontend
header('Content-Type: application/json');
echo $response;


