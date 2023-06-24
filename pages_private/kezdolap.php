<?php
if($_SESSION["user"]["tipus"] == "konyvtaros")
{
echo("
<div class='container'>
    <div class='bg-light p-5 my-3 rounded'>
        <h1>Könyvek lista</h1>
        <p class='lead'>Kattints a könyvek szerkesztéséhez</p>
        <a class='btn btn-lg btn-primary' href='".web::$domain."?oldal=admin_konyvek' role='button'>Könyvek lista</a>
    </div>
</div>");

echo("
<div class='container'>
    <div class='bg-light p-5 my-3 rounded'>
        <h1>Kölcsönzések lista</h1>
        <p class='lead'>Kattints a kölcsönzések szerkesztéséhez</p>
        <a class='btn btn-lg btn-primary' href='".web::$domain."?oldal=admin_kolcsonzesek' role='button'>Könyvek lista</a>
    </div>
</div>");

echo("
<div class='container'>
    <div class='bg-light p-5 my-3 rounded'>
        <h1>Admin oldal</h1>
        <p class='lead'>Kattints a műfajok és típusok szerkeszteséhez</p>
        <a class='btn btn-lg btn-primary' href='".web::$domain."?oldal=admin_admin' role='button'>Könyvek lista</a>
    </div>
</div>");
}
else
{
    echo("
    <div class='container'>
        <div class='bg-light p-5 my-3 rounded'>
            <h1>Údv, kedves ".$_SESSION["user"]["nev"]."</h1>
            <p class='lead'>Lorem ipsum dolor sit amet consectetur adipisicing elit. A vel aspernatur animi facere ullam fuga laborum dignissimos amet corporis assumenda.</p>

        </div>
    </div>");
}
?>

