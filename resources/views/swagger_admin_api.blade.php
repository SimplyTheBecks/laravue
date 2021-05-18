<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <title>Admin API ToxicApps</title>
    <link rel="stylesheet"
          type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.36.0/swagger-ui.min.css" >
    <style>
        .topbar {
            display: none;
        }
    </style>
</head>

<body>
<div id="swagger-ui"></div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.36.0/swagger-ui-bundle.min.js"
        charset="UTF-8"> </script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/swagger-ui/3.36.0/swagger-ui-standalone-preset.min.js"
        charset="UTF-8"> </script>
<script>
    window.onload = function() {
        // Begin Swagger UI call region
        const ui = SwaggerUIBundle({
            url: "./storage/api/admin_api.json",
            dom_id: '#swagger-ui',
            deepLinking: true,
            presets: [
                SwaggerUIBundle.presets.apis,
                SwaggerUIStandalonePreset
            ],
            plugins: [
                SwaggerUIBundle.plugins.DownloadUrl
            ],
            layout: "StandaloneLayout"
        })
        // End Swagger UI call region

        window.ui = ui
    }
</script>
</body>
</html>
