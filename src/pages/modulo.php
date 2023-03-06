<div class="main-content h-100" id="modulo-page">
    <div class="ui top attached h-10 px-1">
        <?php include_once('../src/layout/navbar.php'); ?>
    </div>

    <!-- BIENVENIDA Y VIDEO -->
    <div class="ui centered grid h-30 pb-4">
        <div class="sixteen wide column px-6 pt-4 modulo-header <?= $id == 7 ? "hidden" : "" ?>">
            <h2>Módulo <?= $id ?></h2>
            <h1><?= $modulosNestle[$id]['name'] ?></h1>
            <h3><span>•</span> Paso 1 mira el video</h3>
        </div>

        <div class="sixteen wide column video-interno-modulo px-6 pt-2 <?= $id == 7 ? "hidden" : "" ?>">
            <div class="ui embed video-interno" data-autoplay="true" data-source="youtube" data-id="<?= $modulosNestle[$id]['video'] ?>"></div>
        </div>
    </div>

    <!-- BOTONES DE RANKING -->
    <div style="display: none;"><?php echo $id ?></div>
    <div class="ui centered grid h-10 padded">
        <div class="sixteen wide column px-6 pt-4 modulo-header">
            <h3><span>•</span> Paso <?= $id == 7 ? 1 : 2 ?></h3>
        </div>
        <div class="sixteen wide column pb-1 pt-1">
            <!--<h1 class="text-light text-center module-titles">EVALÚA EL MÓDULO</h1>-->
        </div>
        <div class="sixteen wide column bg-mustard module-franja pt-5 pb-3 pt-1">
            <?php 
            // Condiciones:
            // Se convierte en array el valor de obvervaciones que es una serie de números
            // que representan cada módulo que el usuario puede tener habilitado y posteriormente
            // Se comprueba según el módulo si se le habilita o no cada moódulo
            
            $modulosTemporalesHabilitados = [];
            if($user_session['observaciones'] !== ""){
                $modulosTemporalesHabilitados = explode("|", $user_session['observaciones']);
                array_pop($modulosTemporalesHabilitados);
            }
            ?>
            <?php //$isModuloBloqueado = !(($perfil == 'Nestle Administrativos') || ($opt_in == 3 && $id == 3) || ($opt_in == 4));?>

            
            <?php // $moduloUno = ['0803829696', '0803188838', '0802257667', '0802293928', '0104079629', '0704433895', '0104626577', '0103755906', '0503413528', '1205539370', '1207995836', '1205792664', '1205883265', '1207668250', '1206160846', '0940540859', '0931513758', '0951537869', '0952080497', '0919716613', '0917175473', '0151257268', '0915855514', '0926643529', '0925678195', '0919792804', '0202257408', '1713337655', '0931115489', '0926458829', '0920404225', '1716935695', '1722424247', '1719786947', '0503413528', '1205539370', '1207995836', '1205792664', '1204681462', '1205883265', '1207668250', '1206160846', '0940540859', '0202419123', '0603937798', '0604384123', '0929817682', '0605411651', '0925258394', '0604788323', '1206038539', '0603919341', '0604057190', '1803705423', '1850062272', '1804953832', '1721201869', '0919453910', '1703681252', '0925038457', '0706758679', '0704890326', '1304843558', '0940233354', '0913006037', '0923968549', '0924285000', '0802360354', '0982626694', '0968992365', '2450122987', '1250629803', '2100678701', '2150401103', '1713003968', '17123906408', '1712500378', '1726772419', '1717094187', '0502316334', '1712847605', '1308245636', '1309713285', '1004356257', '1722381140', '1712724424', '1104010275', '0704613454', '0502409238', '1803297165', '0704292044', '0100132109', '1103814941', '1102041744', '0101390516', '0501535603', '0700802309', '1717878928', '1709696635', '1720461662', '1204036485', '0931513758', '0951537869', '0952080497', '0924003130', '0916029572', '0550265771', '1726445495', '1721128708', '1726617689', '1716957426', '1722183157', '1207067396', '0803871599', '1804194452', '1718929134', '1714208889', '1720252665', '0105635106', '1720481058']; ?>
            <?php // $moduloDos = ['0803829696', '0803188838', '0802257667', '0802293928', '0104079629', '0704433895', '0104626577', '0103755906', '0503413528', '1205539370', '1207995836', '1205792664', '1205883265', '1207668250', '1206160846', '0940540859', '0931513758', '0951537869', '0952080497', '0919716613', '0917175473', '0151257268', '0925678195', '0202257408', '1722974084', '1713337655', '0931115489', '0926458829', '0920404225', '1716935695', '1722424247', '1719786947', '2300492713', '0927332486', '1314984699', '1200646428', '0503413528', '1205539370', '1207995836', '1205792664', '1204681462', '1205883265', '1207668250', '1206160846', '0940540859', '0603937798', '0604384123', '0929817682', '0605411651', '0925258394', '0604788323', '1206038539', '0603919341', '0604057190', '1803705423', '1850062272', '1804953832', '1721201869', '0919453910', '0930685995', '1703681252', '0925038457', '0920373768', '0929369684', '0706758679', '0704890326', '1304843558', '0940233354', '0913006037', '0923968549', '0924285000', '0802360354', '0982626694', '0968992365', '2450122987', '1002870408', '1002045456', '1250629803', '2100678701', '2150401103', '1713003968', '17123906408', '1712500378', '1726772419', '1717094187', '0502316334', '1712847605', '1308245636', '1309713285', '1004356257', '1722381140', '1712724424', '1104010275', '0704613454', '0502409238', '1803297165', '0704292044', '0100132109', '1103814941', '1102041744', '0101390516', '0501535603', '0700802309', '1717878928', '1709696635', '1720461662', '0917741464', '1204036485', '0931513758', '0951537869', '0952080497', '0924003130', '0103931580', '0916029572', '1003372495', '1104841638', '0550265771', '1721128708', '1726617689', '1716957426', '0303147771', '1722183157', '1207067396', '0803871599', '1804194452', '1720252665', '0105635106', '1720481058']; ?>
            <?php // $moduloTres = ['0803829696', '0803188838', '0802257667', '0802293928', '0104079629', '0704433895', '0104626577', '0103755906', '0503413528', '1205539370', '1207995836', '1205792664', '1205883265', '1207668250', '1206160846', '0940540859', '0931513758', '0951537869', '0952080497', '0919716613', '1206473496', '0917175473', '0106421852', '1715412449', '0925460602', '0151257268', '0925678195', '0920316734', '0919342733', '0202257408', '1722974084', '1713337655', '0931115489', '0926458829', '1725337933', '1716935695', '1722424247', '1719786947', '0927332486', '1314984699', '1200646428', '0503413528', '1205539370', '1207995836', '1205792664', '1204681462', '1205883265', '1207668250', '1206160846', '0940540859', '0603937798', '0604384123', '0929817682', '0605411651', '0925258394', '0604788323', '1206038539', '0603919341', '0604057190', '1850062272', '1804953832', '1721201869', '0916204282', '0919453910', '0930685995', '1703681252', '0925038457', '0940178650', '0920373768', '0929369684', '0706758679', '0704890326', '1304843558', '0940233354', '0913006037', '0923968549', '0924285000', '0802360354', '0982626694', '0968992365', '2450122987', '1002870408', '1002045456', '1250629803', '2100678701', '2150401103', '1713003968', '17123906408', '1712500378', '1726772419', '1717094187', '0502316334', '1712847605', '1308245636', '1309713285', '1004356257', '1722381140', '1712724424', '1104010275', '0704613454', '0502409238', '1803297165', '0704292044', '0100132109', '1103814941', '1102041744', '0101390516', '0501535603', '0700802309', '1717878928', '1709696635', '1720461662', '0917741464', '1204036485', '0931513758', '0951537869', '0952080497', '0924003130', '0103931580', '0916029572', '0106181266', '0504091414', '1104841638', '0550265771', '0107104317', '0951633726', '1721128708', '1726617689', '1716957426', '0303147771', '1722183157', '1207067396', '0803871599', '1804194452', '1718929134', '1720252665', '0105635106', '1720481058']; ?>
            <?php // $moduloCuatro = ['0803829696', '0803188838', '0802257667', '0802293928', '0104079629', '0704433895', '0104626577', '0103755906', '0503413528', '1205539370', '1207995836', '1205792664', '1205883265', '1207668250', '1206160846', '0940540859', '0931513758', '0951537869', '0952080497', '0919716613', '1206473496', '0103132833', '0917175473', '1718880584', '0106421852', '1715412449', '0925460602', '0151257268', '0925678195', '0919792804', '0919342733', '0202257408', '1722974084', '1713337655', '0931115489', '0926458829', '1725337933', '1716935695', '1722424247', '1719786947', '1200646428', '0503413528', '1205539370', '1207995836', '1205792664', '1204681462', '1205883265', '1207668250', '1206160846', '0940540859', '0202419123', '0603937798', '0604384123', '0929817682', '0605411651', '0925258394', '0604788323', '1206038539', '0603919341', '0604057190', '1103168405', '1850062272', '1804953832', '1721201869', '0916204282', '0919453910', '0930685995', '1703681252', '0925038457', '0940178650', '0920373768', '0929369684', '0706758679', '0704890326', '1304843558', '0940233354', '0913006037', '0923968549', '0924285000', '0850257189', '0802360354', '0401676176', '0982626694', '0968992365', '2450122987', '1002870408', '1002045456', '1250629803', '2100678701', '2150401103', '1713003968', '17123906408', '1712500378', '1726772419', '1717094187', '1312037359', '0502316334', '1712847605', '1308245636', '1309713285', '1004356257', '1722381140', '1712724424', '1104010275', '0704613454', '0502409238', '1803297165', '0704292044', '0100132109', '1103814941', '1102041744', '0101390516', '0501535603', '0700802309', '1717878928', '1709696635', '1720461662', '0917741464', '1204036485', '0931513758', '0951537869', '0952080497', '0924003130', '0103931580', '0916029572', '1003372495', '1104841638', '0550265771', '0107104317', '0951633726', '0927772525', '1721128708', '1726617689', '1716957426', '0303147771', '1722183157', '1207067396', '0803871599', '1804194452', '1760320067', '0503723397', '0603660903', '1718929134', '1002457248', '1718777806', '1714208889', '1720252665', '0105635106', '1720481058']; ?>
            <?php // $moduloCinco = ['0803829696', '0803188838', '0802257667', '0802293928', '0104079629', '0704433895', '0104626577', '0103755906', '0503413528', '1205539370', '1207995836', '1205792664', '1205883265', '1207668250', '1206160846', '0940540859', '0931513758', '0951537869', '0952080497', '0919716613', '1206473496', '0103132833', '0917175473', '1718880584', '1721101176', '0701884660', '0106421852', '1715412449', '0925460602', '0151257268', '1726612342', '0925678195', '0940403918', '0919792804', '0920582517', '0202257408', '1722974084', '1713337655', '1712366770', '0931115489', '0926458829', '1725337933', '0603864174', '0604161539', '0401442819', '1724345416', '0606076495', '0603603051', '0602520835', '0803936772', '0803272608', '1723637722', '1720713898', '1716935695', '1722424247', '1719786947', '0803593458', '0802275602', '0803042225', '1721667911', '1715805949', '1307407609', '1350114441', '1314047158', '1313698704', '0503465973', '1206745505', '1205511569', '1718127796', '1205518788', '1206301051', '1204715286', '1200646428', '0962349742', '0503413528', '1205539370', '1207995836', '1205792664', '1204681462', '1205883265', '1207668250', '1206160846', '0940540859', '0201915741', '0202419123', '0201849452', '0603937798', '0604384123', '0929817682', '0605411651', '0925258394', '0604788323', '1206038539', '0603919341', '0604057190', '1103980452', '1803705423', '1850062272', '1804953832', '1721201869', '0104010764', '0105494546', '0104069349', '0916204282', '0919453910', '1703681252', '0925038457', '0940178650', '0920373768', '0929369684', '0603897323', '0704890326', '1304843558', '0950692467', '0940233354', '0913006037', '0950314005', '0924285000', '0850257189', '0802360354', '0604445809', '0922883939', '0952140648', '0602362261', '0401676176', '0982626694', '0968992365', '2450122987', '0401761085', '1002870408', '1002045456', '1250629803', '1759424268', '1751446491', '2100678701', '1722760392', '1720246923', '1759103367', '1759062712', '1713003968', '17123906408', '1712500378', '1726772419', '1717094187', '1312037359', '0504361403', '0504430224', '0502316334', '1712847605', '1308245636', '1309713285', '1004356257', '1722381140', '1712724424', '1104010275', '0704613454', '0502409238', '1803297165', '0704292044', '0100132109', '1103814941', '1102041744', '0101390516', '0501535603', '0700802309', '1717878928', '1709696635', '1720461662', '0917741464', '0929073773', '0918691676', '1204036485', '0931513758', '0951537869', '0952080497', '0924003130', '0103931580', '0916029572', '0925821431', '0926443946', '0951050483', '0150031789', '1104841638', '0550265771', '0913139911', '0921954319', '0921242988', '1726445495', '1721128708', '1726617689', '1716957426', '1310817901', '0303147771', '0927468751', '1722183157', '1207067396', '0803871599', '1804194452', '1722828868', '1760320067', '1717399537', '0503723397', '0603660903', '1718929134', '0105388979', '1002457248', '0104843867', '0943484105', '0958224099', '0603888322', '1312186529', '1305275859', '1718777806', '1203946486', '0302084876', '1714208889', '0930014311', '1720252665', '1311446965', '0931207047', '0105635106', '1315641736', '1720481058']; ?>
            <?php // $moduloSeis = ['0803829696', '0803188838', '0802257667', '0802293928', '0104079629', '0704433895', '0104626577', '0103755906', '1716081243', '0503413528', '1205539370', '1207995836', '1205792664', '1205883265', '1207668250', '1206160846', '0940540859', '0931513758', '0951537869', '0952080497', '0919716613', '1206473496', '1712511417', '0103132833', '0917175473', '1718880584', '1721101176', '0701884660', '0106421852', '1715412449', '0925460602', '0151257268', '0925678195', '1312004672', '0916829401', '1309928487', '0919342733', '1204569394', '0930237730', '1710961986', '0931115489', '0926458829', '1725337933', '0920744737', '1714209291', '1315268043', '2100132170', '0106278112', '1715533228', '1309724662', '1723637722', '1720713898', '1716935695', '1722424247', '1719786947', '0803593458', '1715805949', '1307407609', '1350114441', '1313690651', '1314047158', '1313698704', '0503465973', '1206745505', '1205511569', '1718127796', '1205518788', '1204489924', '1206301051', '1204715286', '1200646428', '0962349742', '0503413528', '1205539370', '1207995836', '1205792664', '1205947532', '1250210323', '0950684811', '1204681462', '1205883265', '1207668250', '1206160846', '0940540859', '1804574166', '0604059147', '0602584732', '0201915741', '0202419123', '0201849452', '0603937798', '0604384123', '0929817682', '0605411651', '0925258394', '0604788323', '1206038539', '0603919341', '0604057190', '1105186793', '1103980452', '1850062272', '1804953832', '1721201869', '1803333010', '0104010764', '0923310692', '0916204282', '0919453910', '1703681252', '0925038457', '0929585461', '0925717464', '0706555273', '0705393495', '0706114576', '0150950848', '0705749133', '0706128162', '0950382556', '1304843558', '0951804746', '0950692467', '0940233354', '0913006037', '0950314005', '0924285000', '0802360354', '0604445809', '0909921009', '0952140648', '0401676176', '0982626694', '0968992365', '2450122987', '1003399464', '1002870408', '1002045456', '1250629803', '1759424268', '1720006079', '1751438142', '1751958297', '1751446491', '1719778662', '1313738757', '1722760392', '1720246923', '1714615059', '1759103367', '1718394479', '1759062712', '1713003968', '17123906408', '1712500378', '1717094187', '0502316334', '1712847605', '1308245636', '1309713285', '1004356257', '1722381140', '1712724424', '1104010275', '0704613454', '0502409238', '1803297165', '0704292044', '0100132109', '1103814941', '1102041744', '0101390516', '0501535603', '0700802309', '1717878928', '1709696635', '1720461662', '0929073773', '0929116812', '0918691676', '1204036485', '0931513758', '0951537869', '0952080497', '0924003130', '0103931580', '0916029572', '0925821431', '0926443946', '0951050483', '0923074447', '0927697235', '0106181266', '0503415861', '1104841638', '0550265771', '0925863912', '0952258218', '0919406637', '0921242988', '0920865367', '1726445495', '1721128708', '1716957426', '0951693076', '0927468751', '1722183157', '1207067396', '0803871599', '1714338991', '1804194452', '1722828868', '1760320067', '1717399537', '0503723397', '0603660903', '0105388979', '1002457248', '0104843867', '0943484105', '0925103426', '0958224099', '0603888322', '1312186529', '1305275859', '1718777806', '1203946486', '0302084876', '1714208889', '0930014311', '1720252665', '0950722793', '1311446965', '0924878523', '0931207047', '0105635106', '1315641736', '1720481058', '1250083050']; ?>
            <?php // $moduloSiete = ['0803829696', '0803188838', '0802257667', '0802293928', '0104079629', '0704433895', '0104626577', '0103755906', '1719265355','0926178484','0919716613', '1712511417', '0103132833', '1713098026', '2100522453', '1311655862', '1718880584', '0915023105', '0919611509', '1804291019', '0703577247', '0926066176', '0106421852', '0925460602', '0950907840', '0956039598', '0151257268', '1726612342', '1312004672', '0916829401', '0924743859', '0908952542', '0927400416', '1309136313', '0930237730', '0917633323', '1715985816', '1714137831', '1712366770', '0926178484', '0926458829', '1720221595', '1719372821', '1719236125', '0604343129', '1002029732', '0401442819', '1752774941', '1714209291', '1721601647', '1315268043', '0106278112', '0920404225', '1722667365', '1004475065', '1722407226', '1718902644', '1717101222', '1721378147', '1309724662', '1723637722', '1720713898', '1716935695', '1722424247', '1719786947', '0802655472', '0803593458', '0802275602', '0804318962', '0801935313', '0803054204', '1205418278', '0803134261', '0802936757', '0803042225', '0803190461', '1715805949', '1723997225', '1314926971', '1310792302', '0962679585', '1307407609', '1350114441', '0927332486', '1308538089', '1351647555', '1315667954', '1310720337', '1314741206', '1310217854', '1312821984', '1317906178', '1314047158', '1313698704', '1206745505', '1204489924', '1206301051', '1200646428', '0962349742', '0503413528', '1205539370', '1207995836', '1205792664', '1207444959', '0940803612', '1205947532', '1250210323', '1315088896', '1205493974', '0950684811', '1727011171', '1204421992', '1204681462', '1205883265', '1207668250', '1206160846', '0940540859', '0201915741', '0202419123', '0603937798', '0605411651', '0925258394', '0604788323', '1206038539', '0603919341', '0604057190', '1105186793', '1104219249', '1103980452', '1715173975', '1850062272', '1804953832', '1721201869', '0104947080', '0104010764', '0106602022', '0105494546', '0916204282', '0919453910', '0930685995', '1204960031', '0926024571', '0926008632', '0923738223', '1703681252', '0925038457', '0917029803', '0929585461', '0940178650', '0920373768', '0929369684', '0925717464', '0705393495', '0706114576', '0706128162', '0950382556', '1304843558', '0951804746', '0931305239', '0950692467', '0950613778', '0928748045', '0928436823', '0924521123', '0929260206', '0922375381', '0958638272', '0913006037', '0950314005', '0924043862', '0924285000', '0925125585', '0802360354', '0918065228', '0401676176', '1250629803', '1724453988', '1719778662', '1755266044', '1751089978', '1500350838', '1714313507', '2200391445', '2101121693', '2100678701', '2100133368', '2100137914', '2150401103', '2100507322', '1722760392', '1720246923', '1759103367', '1717094187', '0550656540', '0502316334', '1712847605', '1308245636', '1309713285', '1004356257', '1722381140', '1712724424', '1104010275', '0704613454', '0502409238', '1803297165', '1103814941', '1102041744', '0101390516', '0501535603', '1711591196', '0601496821', '1720461662', '0917741464', '1206325001', '0940184500', '0917639973', '0929116812', '0909920209', '0928756204', '0918691676', '0302274055', '1204036485', '0950051755', '1207697747', '0925692220', '0940308257', '1205436999', '0919874586', '0931513758', '0951537869', '0952080497', '0924003130', '1715990279', '1724606528', '1310932742', '1726775339', '1724037427', '1723415921', '1722715792', '1003372495', '0401770524', '1715316590', '1718412339', '1726288929', '1721595708', '1720829785', '1725992083', '0703879692', '0951050483', '0931018758', '0503415861', '1804104147', '1104841638', '0550265771', '1204982456', '0921954319', '0924191927', '0107104317', '1716892748', '1726445495', '1721128708', '0925803934', '1722183157', '1207067396', '0803871599', '1714338991', '1804194452', '1722828868', '1717399537', '0503723397', '0603660903', '0105388979', '1002457248', '0104843867', '0943484105', '0925103426', '0958224099', '0603888322', '1312186529', '1305275859', '1718777806', '1203946486', '0302084876', '1714208889', '0930014311', '1720252665', '0950722793', '1716853724', '1714247960', '1713975256', '1751090000', '1311446965', '0924878523', '0931207047', '0105635106', '1315641736', '1720481058', '1250083050', '0803891134' ]; ?>
            
            
            <?php //echo "CED:" . $user_session['cedula'] ?>
            <?php /*if(in_array($user_session['cedula'],$moduloUno) && $id == 1): ?>
            <?php //if($id == 1): ?>
                    <a href="<?= $site['base_url'] ?>/quiz/?state=check&modulo=1" id="entrar-al-modulo" class="text-light text-center btn py-1 px-3 btn-transparent text-white rounded btn-medium font-size-18">Clic aquí</a>
                    <h3><center>Te queda<?= ($intento > 1 ? "n" : "") ?> <?= $intento ?> intento<?= ($intento > 1 ? "s" : "") ?></center></h3>
            <?php endif; ?>
            
            <?php if(in_array($user_session['cedula'],$moduloDos) && $id == 2): ?>
            <?php //if($id == 2): ?>
                    <a href="<?= $site['base_url'] ?>/quiz/?state=check&modulo=2" id="entrar-al-modulo" class="text-light text-center btn py-1 px-3 btn-transparent text-white rounded btn-medium font-size-18">Clic aquí</a>
                    <h3><center>Te queda<?= ($intento > 1 ? "n" : "") ?> <?= $intento ?> intento<?= ($intento > 1 ? "s" : "") ?></center></h3>
            <?php endif; ?>
            
            <?php if(in_array($user_session['cedula'],$moduloTres) && $id == 3): ?>
            <?php //if($id == 3): ?>
                    <a href="<?= $site['base_url'] ?>/quiz/?state=check&modulo=3" id="entrar-al-modulo" class="text-light text-center btn py-1 px-3 btn-transparent text-white rounded btn-medium font-size-18">Clic aquí</a>
                    <h3><center>Te queda<?= ($intento > 1 ? "n" : "") ?> <?= $intento ?> intento<?= ($intento > 1 ? "s" : "") ?></center></h3>
            <?php endif; ?>
            
            <?php if(in_array($user_session['cedula'],$moduloCuatro) && $id == 4): ?>
            <?php //if($id == 4): ?>
                    <a href="<?= $site['base_url'] ?>/quiz/?state=check&modulo=4" id="entrar-al-modulo" class="text-light text-center btn py-1 px-3 btn-transparent text-white rounded btn-medium font-size-18">Clic aquí</a>
            <?php endif; ?>
            
            <?php if(in_array($user_session['cedula'],$moduloCinco) && $id == 5): ?>
            <?php //if($id == 5): ?>
                    <a href="<?= $site['base_url'] ?>/quiz/?state=check&modulo=5" id="entrar-al-modulo" class="text-light text-center btn py-1 px-3 btn-transparent text-white rounded btn-medium font-size-18">Clic aquí</a>
            <?php endif; ?>
            
            <?php if(in_array($user_session['cedula'],$moduloSeis) && $id == 6): ?>
            <?php //if($id == 6): ?>
                    <a href="<?= $site['base_url'] ?>/quiz/?state=check&modulo=6" id="entrar-al-modulo" class="text-light text-center btn py-1 px-3 btn-transparent text-white rounded btn-medium font-size-18">Clic aquí</a>
            <?php endif; ?>
            
            <?php //if(in_array($user_session['cedula'],$moduloSiete) && $id == 7): ?>
            <?php if($id == 7 && ($perfil !== 'Nestle Administrativos' || in_array($user_session['cedula'],$moduloSiete))): ?>
                    <a href="<?= $site['base_url'] ?>/quiz/?state=check&modulo=7" id="entrar-al-modulo" class="text-light text-center btn py-1 px-3 btn-transparent text-white rounded btn-medium font-size-18">Clic aquí</a>
            <?php endif;*/ ?>
            
            <h3 class="mb-6"><center>Solo con las <?= $id == 7 ? 15 : 5 ?> preguntas correctas obtienes puntaje</center></h3>
            
            
            
            
            <?php //if($hasNotPerfectScore && $id == 6 && ($perfil == 'Nestle Administrativos')): ?>
            <?php /*if($hasNotPerfectScore && ($perfil !== 'Nestle Administrativos')): ?>
                <?php if($intento > 0): ?>
                    <a href="<?= $site['base_url'] ?>/quiz/?state=check&modulo=<?= $id ?>" id="entrar-al-modulo" class="text-light text-center btn py-1 px-3 btn-transparent text-white rounded btn-medium font-size-18">Clic aquí</a>
                    <h3><center>Te queda<?= ($intento > 1 ? "n" : "") ?> <?= $intento ?> intento<?= ($intento > 1 ? "s" : "") ?></center></h3>
                <?php elseif($intento <= 0): ?>
                    <h3><center>Lo sentimos, has perdido todos tus intentos para este módulo.</center></h3>
                <?php endif; ?>
            <?php else: ?>    
                <h3><center>Ya has obtenido puntaje para esta evaluación<br> o tu perfíl está deshabilitado.</center></h3>
            <?php endif; ?>
        </div>
        <?php if ($hasNotPerfectScore): ?>
            <h3 class="mb-6"><center>Solo con las <?= $id == 7 ? 15 : 5 ?> preguntas correctas obtienes puntaje</center></h3>
        <?php endif;*/ ?>
    </div>
    
    <!-- RECURSOS -->
    <?php if($recurso){ ?>
    <div class="ui centered grid h-10 padded pb-1">
    <div class="sixteen wide column px-6 pt-4 modulo-header">
            <h3><span>•</span> Paso 3</h31>
        </div>
        <div class="sixteen wide column pb-1 pt-1">
            <h1 class="text-light text-center module-titles">Descarga recursos adicionales</h1>
        </div>
    </div>
    
        <?php foreach($recurso as $k => $v){ ?>
        <div class="ui centered grid justify-content-center align-items-center h-10 padded pb-9">
            <div class="two wide bordered border p-1 column recurso-wrapper d-flex justify-content-center">
                <a href="<?= $site['base_url'] ?>/<?= $v['url'] ?>" download><img src="<?= $site['base_url'] ?>/assets/img/icon/<?= $v['tipo'] ?>.png" class="icono-recurso"></a>
            </div>
            <div class="twelve wide bordered border p-0 column recurso-wrapper d-flex justify-content-center align-items-start">
                <a href="<?= $site['base_url'] ?>/<?= $v['url'] ?>" download><h4 class="color-white font-size-14 text-left mt-1"><?= $v['nombre'] ?></h4></a>
            </div>
        </div>
        <?php } ?>
    <?php } ?>
    
    <div class="ui bottom attached h-5" id='bottom-menu'>
        <div class="bottom-menu-bar bg-mustard user-menu-links">
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/puntaje/" class="">Mi puntaje</a>
            <a class="text-light bottom-menu-link" href="<?= $site['base_url'] ?>/perfil/" class="">Mi perfil</a>
        </div>
    </div>

</div>
<script>
var intento_actual = <?= $intento ?>;
var checkVideo = true;

(function($){

    // INICIAR QUIZ
    $( document ).ready(function(){
        $("#entrar-al-modulo").click(function(e){
            // e.preventDefault();
            // e.stopPropagation();
            // Swal.fire({
            //     title : "Alerta",
            //     icon: "info",
            //     html : "<strong>Solo con las 5 preguntas correctas obtienes puntaje</strong>"
            // });
            if(intento_actual <= 3 && checkVideo == true){
                e.preventDefault();
                e.stopPropagation();
                Swal.fire({
                    title : "Alerta",
                    icon: "info",
                    html : "Para continuar no olvides ver el video.<br><strong>Solo con las <?= $id == 7 ? 15 : 5 ?> preguntas correctas obtienes puntaje.</strong>"
                });
                checkVideo = false;
            }
        });
    });

}(jQuery));
</script>