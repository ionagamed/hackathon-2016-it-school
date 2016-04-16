<!DOCTYPE html>
<html>
<head>
  <title>IT Group</title>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js'></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/moment.min.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.12.0/locale/ru.js'></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js'> </script>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css'>
  <meta charset='utf-8'>

  <style>
    body {
      padding-top: 1em;
    }
  </style>
</head>
<body>
<div class="container">
  <div class='panel panel-default'>
    <div class='panel-heading'>
      Информация
    </div>
    <div class='panel-body'>
      <div class='row'>
        <form id='form'>
          <div class='col-md-4'>
            <div class='input-group'>
              <label class='input-group-addon ' for='login'>
                Логин
              </label>
              <input class='form-control' type='text' name='search' id='search' value='{{ old("search") }}'>
            </div>
          </div>
          <div class='col-md-6'>
            <div class='input-group'>
              <label class='input-group-addon'>
                от
              </label>
              <input type='text' class='form-control datepicker' id='from' value='01.01.1970 00:00'>
              <label class='input-group-addon'>
                до
              </label>
              <input type='text' class='form-control datepicker' id='to' value='01.01.2070 00:00'>
            </div>
          </div>
          <input type='hidden' name='ts_begin' id='ts_begin' value='1970-01-01 00:00:00'>
          <input type='hidden' name='ts_end' id='ts_end' value='2070-01-01 00:00:00'>
          <div class='col-md-2'>
            <button type='submit' class='btn btn-block btn-primary'>
              <span class='glyphicon glyphicon-search'></span>
              Фильтр
            </button>
          </div>
        </form>
      </div>
      <hr>
      @if(!$users->isEmpty())
      <table class='table'>
        <thead>
        <tr>
          <td>Логин</td>
          <td>MAC-адрес</td>
          <td>IP-адрес</td>
          <td>Зашел</td>
          <td>Вышел</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
          <tr>
            <td>{{ $user->login }}</td>
            <td>{{ $user->mac }}</td>
            <td>{{ $user->ip }}</td>
            <td class='df'>{{ $user->ts_begin }}</td>
            <td class='df'>{{ $user->ts_end }}</td>
          </tr>
        @endforeach
        </tbody>
      </table>
      @else
        <p>Нет результатов</p>
      @endif
      {{ $users->appends(Input::except("page"))->render() }}
    </div>
  </div>
</div>
<script type='text/javascript'>
  $(".datepicker").each(function() {
    $(this).datetimepicker({
      locale: "ru"
    });
  });
  $("#from").on("dp.change", function() {
    $("#ts_begin")[0].value = $(this).data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss");
  });
  $("#to").on("dp.change", function() {
    $("#ts_end")[0].value = $(this).data("DateTimePicker").date().format("YYYY-MM-DD HH:mm:ss");
  });
  $("#from")[0].value = moment('{{ old("ts_begin") }}').format("DD.MM.YYYY HH:mm");
  $("#to")[0].value = moment('{{ old("ts_end") }}').format("DD.MM.YYYY HH:mm");
  $(".df").each(function () {
    $(this).html(moment($(this).html()).format("DD.MM.YYYY HH:mm"));
  });
</script>
</body>
</html>
