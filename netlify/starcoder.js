export async function handler(event, context) {
  const inputText = new URLSearchParams(event.body).get('input');

  const response = await fetch(
    'https://api-inference.huggingface.co/models/bigcode/starcoder2-3b',
    {
      method: 'POST',
      headers: {
        Authorization: 'Bearer YOUR_HUGGING_FACE_API_KEY',
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        inputs: inputText,
        parameters: {
          max_new_tokens: 100,
          temperature: 0.2,
        },
      }),
    }
  );

  const data = await response.json();

  return {
    statusCode: 200,
    body: JSON.stringify(data),
  };
}
