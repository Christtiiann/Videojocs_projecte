<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca de Videojocs</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #1a1a1a;
            color: #fff;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 40px 0;
            margin-bottom: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        h1 {
            margin: 0;
            font-size: 48px;
        }

        nav {
            background-color: #444;
            color: #fff;
            padding: 15px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: center;
        }

        nav ul li {
            display: inline-block;
            margin: 0 15px;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 18px;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #007bff;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .watermark {
            position: fixed;
            bottom: 10px;
            right: 10px;
            font-size: 14px;
            color: #888;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            createWatermark();
            createDynamicLinks();
        });

        function createWatermark() {
            const watermark = document.createElement('div');
            watermark.classList.add('watermark');
            watermark.textContent = 'Christian Garcia Oliver';
            document.body.appendChild(watermark);
        }

        function createDynamicLinks() {
            const nav = document.querySelector('nav ul');
            const linksData = [
                { href: 'formulario_plataforma.php', text: 'Alta de Plataformes' },
                { href: 'form_desenvolupador.php', text: 'Alta desenvolupadors' },
                { href: 'form_genere.php', text: 'Alta de Gèneres' },
                { href: 'form_videojocs.php', text: 'Alta de Videojoc' },
                { href: 'form_Consulta_modificacio_eliminacio_videojoc.php', text: 'Elimina, Modificar i Consulta de Videojocs' },
                { href: 'form_Consulta_modificacio_eliminacio_plataforma.php', text: 'Elimina, Modificar i Consulta de plataforma' },
                { href: 'form_Consulta_modificacio_eliminacio_desenvolupador.php', text: 'Elimina, Modificar i Consulta de desenvolupador' },
                { href: 'form_Consulta_modificacio_eliminacio_genere.php', text: 'Elimina, Modificar i Consulta de genere' }
            ];

            linksData.forEach(linkInfo => {
                const listItem = document.createElement('li');
                const anchor = document.createElement('a');
                anchor.href = linkInfo.href;
                anchor.textContent = linkInfo.text;
                listItem.appendChild(anchor);
                nav.appendChild(listItem);
            });
        }
    </script>
</head>
<body>

<header>
    <h1>Biblioteca de Videojocs</h1>
</header>

<nav>
    <ul></ul>
</nav>

<footer>
    <p>&copy; 2024 Biblioteca de Videojocs</p>
</footer>

</body>
</html>
