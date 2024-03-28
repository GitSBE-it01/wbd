<?php

function CorsMiddleware($request, $response) {
  // Define allowed origins (replace with your allowed origins)
  $allowedOrigins = [
        'http://informationsystem.sbe.co.id:8080/', 
        'http://192.168.2.103:8080/'
        ];

  // Access origin from request headers (if present)
  $origin = $request->getHeaderLine('Origin');

  // Check if origin is allowed
  if (in_array($origin, $allowedOrigins)) {
    $response = $response->withHeader('Access-Control-Allow-Origin', $origin);
  } else {
    // Handle disallowed origin (optional: send error response)
    $response = $response->withStatus(403); // Forbidden
  }

  // Set other CORS headers (adjust as needed)
  $response = $response->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
  $response = $response->withHeader('Access-Control-Allow-Headers', 'Content-Type, Authorization');
  $response = $response->withHeader('Access-Control-Allow-Credentials', 'true');

  return $response;
}

?>