<form method="post" action="">
	<div class="panel-body" style="font-family: Franklin Gothic Medium;text-transform: uppercase;color: #9f9f9f;">Настройки плагина</div>
	<div class="table-responsive">
	<table class="table table-striped">
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Выбрать тему:</h6>
		  <span class="text-muted text-size-small hidden-xs">Которая будет отображаться при наведении мыши</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<select name="hint">{{ hint }}</select>
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Иконки:</h6>
		  <span class="text-muted text-size-small hidden-xs">Отображать иконки в hint</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<select name="icon">{{ icon }}</select>
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Разделитель в списке пользователей.</h6>
		  <span class="text-muted text-size-small hidden-xs">По умолчанию запятая</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<input type="text" name="separator" value="{{ separator }}" class="form-control" style="max-width:40px; text-align: center;">
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Cколько столбцов выводить у последних посетителей..</h6>
		  <span class="text-muted text-size-small hidden-xs">Если столбец один, то разделитель не выводится.<br />(По умолчанию 1 стоолбец)</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<select name="num_user_last">{{ num_user_last }}</select>
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Cколько столбцов выводить у посетителей за сегодня..</h6>
		  <span class="text-muted text-size-small hidden-xs">Если столбец один, то разделитель не выводится.<br />(По умолчанию 1 столбец)</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<select name="num_user_vizit">{{ num_user_vizit }}</select>
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Отображать ИП адресс робота:</h6>
		  <span class="text-muted text-size-small hidden-xs">Включить отображения ИП адресса у поисковиков</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<select name="robo_ip">{{ robo_ip }}</select>
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Отображать ГЕО определения робота:</h6>
		  <span class="text-muted text-size-small hidden-xs">Включить отображения geoip у поисковиков (флаг, город, страна)</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<select name="robo_geo">{{ robo_geo }}</select>
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Отображать ИП адресс гостя:</h6>
		  <span class="text-muted text-size-small hidden-xs">Включить отображения ИП адресса у поситителей</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<select name="guest_ip">{{ guest_ip }}</select>
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Отображать ГЕО определения гостя:</h6>
		  <span class="text-muted text-size-small hidden-xs">Включить отображения geoip у поситителей (флаг, город, страна)</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<select name="guest_geo">{{ guest_geo }}</select>
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Лимит:</h6>
		  <span class="text-muted text-size-small hidden-xs">Задать лимит пользователей в разделе посетителей за сегодня<br />(По умолчанию: <b>20</b>)</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<input type="number" name="limit" value="{{ limit }}" class="form-control" style="max-width:80px; text-align: center;">
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Сколько по времени отображать посетителей за сегодня:</h6>
		  <span class="text-muted text-size-small hidden-xs">Если значение будет больше чем время очистки БД, то сработает последнее.<br />(По умолчанию: <b>3600</b>)</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<input type="number" name="vtimeout" value="{{ vtimeout }}" class="form-control" style="max-width:80px; text-align: center;">
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Сколько по времени отображать пользователей в сети:</h6>
		  <span class="text-muted text-size-small hidden-xs">Онлайн пользователи за последние N секунд<br />(По умолчанию: <b>300</b>)</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<input type="number" name="timeout" value="{{ timeout }}" class="form-control" style="max-width:80px; text-align: center;">
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Время очистки БД от старых записей</h6>
		  <span class="text-muted text-size-small hidden-xs">(По умолчанию: <b>3600</b>)</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
			<input type="number" name="time_clear" value="{{ time_clear }}" class="form-control" style="max-width:80px; text-align: center;">
        </td>
      </tr>
      <tr>
        <td class="col-xs-6 col-sm-6 col-md-7">
		  <h6 class="media-heading text-semibold">Выберите каталог из которого плагин будет брать шаблоны для отображения</h6>
		  <span class="text-muted text-size-small hidden-xs"><b>Шаблон сайта</b> - плагин будет пытаться взять шаблоны из общего шаблона сайта; в случае недоступности - шаблоны будут взяты из собственного каталога плагина<br /><b>Плагин</b> - шаблоны будут браться из собственного каталога плагина</span>
		</td>
        <td class="col-xs-6 col-sm-6 col-md-5">
		  {{ localsource }}
        </td>
      </tr>
	</table>
	</div>
	<div class="panel-footer" align="center">
		<button type="submit" name="submit" class="btn btn-outline-primary">Сохранить</button>
	</div>
</form>