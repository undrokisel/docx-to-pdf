<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Converter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="min-height:50px">
    <div class="container">
    </div>
</nav>

<div class="container my-5">

    <h1 class="text-center my-5">Конвертер из формата docx в pdf</h1>
    <hr class="col-12 my-5">
    <div class="row">
        <form action="{{ route('docx-to-pdf') }}" method="post" enctype="multipart/form-data"
              class="needs-validation">
            @csrf
            <div class="form-group has-validation">
                <label class="mb-4">Загрузите файл в формате docx</label>
                <input type="file"
                       id="userfile"
                       required
                       class="form-control mb-5"
                       name="userfile"
                       onchange="validateFile(this)"
                       placeholder="Загрузите файл в формате docx"
                >
                <button id="submitBtn" type="submit" class="btn btn-primary">
                    Конвертировать и сохранить результат в pdf
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script src="main.js"></script>
<script>
  function validateFile(input) {
    let file = input.files[0];
    let reader = new FileReader()
    reader.readAsArrayBuffer(file)
    reader.onload = function (e) {
      let arr = new Int8Array(e.target.result);
      let fileSize = arr.length;
      if (fileSize > 5242880) {
        alert('Файл слишком большого размера. Подойдут только файлы не более 5 мб');
        document.querySelector('input[type=file]').value = '';
      }
      let extention = file.name.split(".").splice(-1, 1)[0];
      if (extention !== 'DOCX' && extention !== 'docx') {
        alert('Подходят только файлы формата docx (DOCX)!');
        document.querySelector('input[type=file]').value = '';
      }
    }
  }
</script>


</body>
</html>


