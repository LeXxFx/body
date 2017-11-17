<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
<?
//echo "<pre>";
//print_r($arResult);
//echo "</pre>";
?>
<nav id="navi">
	<ul>
		<?foreach($arResult["SECTIONS"] as $sections):?>
		<?//echo "<pre>";print_r($sections);echo "</pre>";?>
		<li>
			<a href="<?=$sections["SECTION_PAGE_URL"]?>" data-id="<?=$sections["ID"]?>">
				<!--<span class="lbl">- 15%</span>-->
				<?if(!empty($sections["PICTURE"]["SRC"])):?>
				<div class="navi-icon">
					<img class="svg" src="<?=$sections["PICTURE"]["SRC"]?>" alt="<?=$sections["NAME"]?>"/>
				</div>
				<?endif;?>
				<span><?=$sections["NAME"]?></span>
			</a>
			<?
				$childSections = array();
				$rsParentSection = CIBlockSection::GetByID($sections["ID"]);
					if ($arParentSection = $rsParentSection->GetNext()){
						$arFilter = array('IBLOCK_ID' => $arParentSection['IBLOCK_ID'],'>LEFT_MARGIN' => $arParentSection['LEFT_MARGIN'],'<RIGHT_MARGIN' => $arParentSection['RIGHT_MARGIN'],'>DEPTH_LEVEL' => $arParentSection['DEPTH_LEVEL']); // выберет потомков без учета активности
						$rsSect = CIBlockSection::GetList(array('left_margin' => 'asc'),$arFilter);
							while ($arSect = $rsSect->GetNext())
								{
									array_push($childSections,$arSect);
								}
					}
			?>
			<?if(!empty($childSections)):?>
			<div class="dropdown-menu">
				<div class="img">
				<img src="<?=$sections["PICTURE"]["SRC"]?>" alt=""/>
				</div>
				<?foreach($childSections as $child):?>
				<ul>
					<li><a href="<?=$child["SECTION_PAGE_URL"]?>"><?=$child["NAME"]?></a></li>
				</ul>
				<?endforeach;?>
				<div class="bot">
					<a href="#" class="btn">Посмотреть все</a>
				</div>
			</div>
			<?endif;?>
		</li>
	<?endforeach;?>
	</ul>
</nav>
<div class="nav-toggle">
	<button type="button">
		<span class="lines"></span>
	</button>
</div>