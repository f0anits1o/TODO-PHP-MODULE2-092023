<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="blabla.php?id=<?php echo @$tache['id']; ?>"><div style="width: 410px; height:100px"></div><input type="checkbox" name="" id="chec"></a>
    <script>
        chec = document.getElementById('chec');
        chec.addEventListener('click', function(){
            if (chec.checked){
                console.log('checked');
            

            }else {
                console.log('chec');
            }
        })
    </script>
</body>
</html>