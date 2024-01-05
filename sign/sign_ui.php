<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.bootcss.com/jquery/3.4.1/jquery.min.js"></script>
    <title>Document</title>
</head>

<body>
    <form action="http://sign.njpi/api/sign.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="save">
        请选择用户名：
        <select name="userid" id="user">
            <option>请选择</option>
            <option value="3">张三</option>
            <option value="4">李四</option>
        </select>
        <br>
        请选择签名图片：
        <input type="file" name="sign">
        <br>
        <button>提交</button>
    </form>
    <script>
    $.ajaxl({
            url: 'http://sign.njpi/api/user.php',
            method: 'get',
            data: {
                "action": "query"
            },
            success: (res) => {
                var users = JSON.parse(res).data;
                //获取select对象
                //const select = document.querySelector("#userid");
                for (let user of users) {
                    // 使用 jQuery 创建一个新的 <option> 元素
                    var newOption = $('<option>', {
                        value: user.id,
                        text: user.username
                    });
                    // 将新的 <option> 插入到 <select> 中
                    $('#userid').append(newOption);
                }
            }
        }) 
        </script>
</body>

        </html>