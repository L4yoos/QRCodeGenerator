<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Generator</title>
    <link rel="icon" href="https://i.postimg.cc/6pDHft66/printer-svgrepo-com.png">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <div class="container mx-auto px-4 pt-16">
        <h1 class="mb-8 uppercase tracking-wider text-black text-lg font-bold text-center">QR Code Generator</h1>
        <div class="flex mb-4 gap-4 items-center justify-center">
            <div class="mt-3">
                <a class="inline-flex items-center px-4 py-2 bg-white text-gray-800 font-bold rounded border-b-2 border-blue-500 hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center transition ease-in-out duration-300" href="../">
                    Normal
                </a>
            </div>
            <div class="mt-3">
                <a class="inline-flex items-center px-4 py-2 bg-white text-gray-800 font-bold rounded border-b-2 border-green-500 hover:border-green-600 hover:bg-green-500 hover:text-white shadow-md py-2 px-6 inline-flex items-center transition ease-in-out duration-300" href="index.php">
                    Wi-Fi
                </a>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-4 sm:p-8 bg-gray-200 text-white shadow sm:rounded-lg">
                <form id="myForm">
                    <div class="form-group">
                        <label>
                            <span class="block text-sm font-medium text-slate-700">Network/SSID</span>
                            <input type="text" name="network" class="placeholder:italic placeholder:text-slate-400 block bg-white text-black w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm">
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                        <span class="block text-sm font-medium text-slate-700">Password</span>
                        <input type="text" name="password" class="placeholder:italic placeholder:text-slate-400 block bg-white text-black w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm">
                        </label>
                    </div>
                    <div class="form-group">
                        <label>
                        <span class="block text-sm font-medium text-slate-700">Encryption</span>
                        <select name="encryption" class="placeholder:italic placeholder:text-slate-400 block bg-white text-black w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" value="200">
                        <option value="WPA">WPA/WPA2</option>
                        <option value="WEP">WEP</option>
                        <option value="nopass">None</option>
                        </select>
                    </div>
                    <a class="mt-4 float-left focus:outline-none text-white bg-yellow-700 hover:bg-yellow-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" href="" target="_blank">Download</a>
                    <button type="submit" class="mt-4 float-right focus:outline-none text-white bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Generate</button>
                </form>
            </div>
            <div class="p-4 sm:p-8 bg-gray-200 shadow sm:rounded-lg relative inset-0 flex" id="myData">
                <img id="imgElem" src="" class="mx-auto"></img>
            </div>
        </div>
        </div>
        <footer class="footer">
        <div class="container text-center mx-auto text-sm px-4 py-6">
            Designed By <a href="https://github.com/L4yoos" class="uppercase tracking-wider text-black font-bold hover:text-green-600">Konrad Dalecki</a>
        </div>
        </footer>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#myForm').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: "../generatewifi.php",
                type: "POST",
                data: $(this).serialize(),
                success: function(data){
                    var imgElem = document.getElementById('imgElem');
                    var baseStr64 = data;
                    var aElem = $("a").get(-2);

                    // hrefElem.attr('href', data);
                    $(aElem).attr("href", data);
                    $(aElem).attr("download", "");
                    imgElem.setAttribute('src', data);
                },
                error: function(){
                    alert("Form submission failed!");
                }
            });
        });
    });
    </script>
</body>
</html>