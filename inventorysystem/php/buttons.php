<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title> Buttons </title>
        <style>
            *{
                box-sizing: border-box;
                font-family: "raleway","tahoma",sans-serif;
            }
            
        </style>
    </head>
    <body>
        <table border="1px" cellpadding="2" colspan="2">
            <td>Figure</td>
            <td>Syntax</td>
            <td>Colors</td>
            <td>Size</td>
            <tr>
            <td><button class="butn butn-sm">Default</button></td>
            <td><p>butn butn-sm butn-sucess</p></td>
            <td><p>#c5c5c5</p></td>
            <td><p>
                <pre>
                min-width: 80px;
                width: auto;
                height: 30px;
                </pre>
            </p></td>
            </tr>
            <tr>
            <td><button class="butn butn-sm butn-success">Success</button></td>
            <td><p>butn butn-sm butn-sucess</p></td>
            <td><p>#6ba003</p></td>
            <td><p>
                <pre>
                 width:auto;
                 height:40px;
                </pre>
            </p></td>
            </tr>
            <tr>
            <td><button class="butn butn-md butn-danger">Danger</button></td>
            <td><p>butn butn-sm butn-sucess</p></td>
            <td><p>#ba0004</p></td>
            <td><p>
                <pre>
                min-width: 90px;
                width:auto;
                height:40px;
                </pre>
            </p></td>
            </tr>
            <tr>
            <td><button class="butn butn-lg butn-primary">Primary</button></td>
            <td><p>butn butn-sm butn-sucess</p></td>
            <td><p>#004881</p></td>
            <td><p>
                <pre>
                min-width: 100px;
                width: auto;
                height: 50px;
                </pre>
            </p></td>
            </tr>
        </table>
    </body>
</html>