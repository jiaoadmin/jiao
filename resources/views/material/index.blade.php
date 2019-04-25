<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>素材上传</title>
</head>
<body>
<form action="/material/upd" method="post" enctype="multipart/form-data">
    <!--  <table>
          <tr>
              <td>标题</td>
              <td></td>
          </tr>
          <tr>
              <td>描述</td>
              <td></td>
          </tr>
          <tr>
              <td>图片</td>
              <td></td>
          </tr>
          <tr>
              <td>链接</td>
              <td></td>
          </tr>
          <tr>
              <td>添加</td>
              <td></td>
          </tr>
      </table>-->
    @csrf
    <input type="file" name="material">
    <input type="submit" value="提交">
</form>
</body>
</html>