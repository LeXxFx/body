<?
/**
 * @global CMain $APPLICATION
 * @param array $arParams
 * @param array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();
?>
<div id="wrapper" role="main">
	<div class="container">
		<div id="breadcumbs">
			<a href="#">Главная</a><span class="sep">/</span> <span class="current">Личный кабинет</span>
		</div>
		<?
		//echo "<pre>";
		//print_r($arResult);
		//echo "</pre>";
		?>
		<?ShowError($arResult["strProfileError"]);?>
		<?
		if ($arResult['DATA_SAVED'] == 'Y')
			ShowNote(GetMessage('PROFILE_DATA_SAVED'));
		?>
		<script type="text/javascript">
		<!--
		var opened_sections = [<?
		$arResult["opened"] = $_COOKIE[$arResult["COOKIE_PREFIX"]."_user_profile_open"];
		$arResult["opened"] = preg_replace("/[^a-z0-9_,]/i", "", $arResult["opened"]);
		if (strlen($arResult["opened"]) > 0)
		{
			echo "'".implode("', '", explode(",", $arResult["opened"]))."'";
		}
		else
		{
			$arResult["opened"] = "reg";
			echo "'reg'";
		}
		?>];
		//-->

		var cookie_prefix = '<?=$arResult["COOKIE_PREFIX"]?>';
		</script>
		<div id="account">
			<ul class="nav nav-tabs">
				<li class="active"><a href="/personal/profile/"><span>Личные даные</span></a></li>
				<li><a href="/personal/orders/"><span>История заказов</span></a></li>
			</ul>
			<form class="form-horisontal" method="post" name="form1" action="<?=$arResult["FORM_TARGET"]?>" enctype="multipart/form-data">
			<?=$arResult["BX_SESSION_CHECK"]?>
			<input type="hidden" name="lang" value="<?=LANG?>" />
			<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
				<div class="form-group">
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label">Фамилия</label>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label">Имя</label>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label">Отчество</label>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="SECOND_NAME" maxlength="50" value="<?=$arResult["arUser"]["SECOND_NAME"]?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label">Контактный телефон <span class="required">*</span></label>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control masked-phone" name="PERSONAL_MOBILE" maxlength="255" value="<?=$arResult["arUser"]["PERSONAL_MOBILE"]?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label">Em@il<?//=GetMessage('EMAIL')?><?if($arResult["EMAIL_REQUIRED"]):?><span class="required">*</span><?endif?></label>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label">Логин</label>
						</div>
						<div class="col-sm-9">
							<input type="text" class="form-control" name="LOGIN" maxlength="50" value="<? echo $arResult["arUser"]["LOGIN"]?>" />
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-sm-3">
							<label class="control-label">Адрес доставки</label>
						</div>
						<div class="col-sm-9">
							<textarea cols="10" class="form-control" rows="2" name="PERSONAL_STREET"><?=$arResult["arUser"]["PERSONAL_STREET"]?></textarea>
						</div>
					</div>
				</div>
				<div class="form-group">
				<script type="text/javascript">
						function showMe (box) {
						var vis = (box.checked) ? "block" : "none";
						document.getElementById('show').style.display = vis;
						};
				</script>
					<div class="row">
						<div class="col-sm-3 col-pass">
							<label class="control-label">Сменить пароль</label>
							<div class="checkbox">
								<label>
									<input type="checkbox" value="" onclick="showMe(this)">
									<span class="txt">&nbsp;</span>
								</label>
							</div>
						</div>
						<div class="col-sm-9">
							<div id="show" class="row">
								<div class="col-sm-6">
									<div class="row">
										<div class="col-lg-6">
											<label class="control-label">Новый пароль</label>
										</div>
										<div class="col-lg-6">
											<input type="password" class="form-control" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="bx-auth-input" />
												<?if($arResult["SECURE_AUTH"]):?>
																<span class="bx-auth-secure" id="bx_auth_secure" title="<?echo GetMessage("AUTH_SECURE_NOTE")?>" style="display:none">
																	<div class="bx-auth-secure-icon"></div>
																</span>
																<noscript>
																<span class="bx-auth-secure" title="<?echo GetMessage("AUTH_NONSECURE_NOTE")?>">
																	<div class="bx-auth-secure-icon bx-auth-secure-unlock"></div>
																</span>
																</noscript>
												<script type="text/javascript">
												document.getElementById('bx_auth_secure').style.display = 'inline-block';
												</script>
												<?endif?>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="row">
										<div class="col-lg-6">
											<label class="control-label">Повторите</label>
										</div>
										<div class="col-lg-6">
											<input type="password" class="form-control is_required" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" />
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-bot">
					<div class="row">
						<div class="col-sm-12">
							<input class="btn btn-cancel" type="reset" value="<?=GetMessage('MAIN_RESET');?>">
							</a>
							<input type="submit" class="btn btn-save" name="save" value="<?=(($arResult["ID"]>0) ? GetMessage("MAIN_SAVE") : GetMessage("MAIN_ADD"))?>">
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>