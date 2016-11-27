<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <script type="application/javascript" src="/bookshop/public/js/jquery-3.1.1.js"></script>
    <title><?php echo Application::$App->title; ?></title>
</head>
<body class="" style="">
    <div class="container">
        <?php foreach ($content as $value) { echo $value; } ?>        
    </div>
</body>
</html>