<?php


namespace App\Services;


use GuzzleHttp\Client;


class GroqService
{
protected $client;
protected $base = 'https://api.groq.com/openai/v1';


public function __construct()
{
$this->client = new Client([
'base_uri' => $this->base,
'timeout' => 30,
]);
}


/**
* Send chat messages to Groq Chat Completions
* @param array $messages // array of ['role' => 'user'|'system'|'assistant', 'content' => '...']
* @param array $options
*/
public function chat(array $messages, array $options = [])
{
$body = array_merge([
'model' => 'llama-3.1-8b-instant',
'messages' => $messages,
'temperature' => 0.5,
'max_tokens' => 1024,
], $options);


$resp = $this->client->post($this->base.'/chat/completions', [
'headers' => [
'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
'Content-Type' => 'application/json',
],
'json' => $body,
]);


$data = json_decode((string)$resp->getBody(), true);
return $data;
}
}