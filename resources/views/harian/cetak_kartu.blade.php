<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
{{--     
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="http://davidshimjs.github.io/qrcodejs/qrcode.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
    <input id="text" value="{{$url->url}}harian/absen/{{$id}}" type="hidden"/>
    <div id="qrcode"></div>
</body window.onload = function() { window.print(); }> 
</html>
<script>

var qrcode = new QRCode("qrcode", { width:150, height:150 });

$("#text").on("keyup", function () {
qrcode.makeCode($(this).val());
}).keyup().focus();

$(document).ready(function () {
    window.print();
});
</script>