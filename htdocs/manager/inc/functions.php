<?php
/**
 * @param array - array �� ����������� ����� � QueryString, ��������: array('begin', '30')
 * @delete array - array �� ��������� ������� ���� �������, ��������: array('begin', '30')
 */
function noRepeatGet($array = array(), $delete = array()){
  $sGet = '?';

  $aGet = array_merge($_GET, $array);
  for ($i=0; $i<count($delete); $i++){ // ������
    foreach ($aGet as $key => $val){
      if ($key == $delete[$i]) unset($aGet[$key]);
    }
  }

  foreach ($aGet as $key => $val) $sGet .= $key . '=' . $val . '&';
  $sGet = substr($sGet, 0, -1);
  return $sGet;
}

/**
 * ����� �������
 * @param count - ���-�� �����������
 * @param per_page - ���-�� ����������� �� ��������
 * @param pages - ���-�� ������� ��� ������� ����� �������� ������
 * @param begin - ���� � $_GET ������� �������� �� ������ �������
 * @param end - ���� � $_GET ������� �������� �� ���-�� ����������� �� ��������
 */
function getPages($count, $per_page, $pages = 10, $begin = 'begin', $end = 'end'){
  $count1 = $count2 = $count;
  if ($count > $per_page){
    $i = 1; // ��������� ������
    $j = 0; // ��������� �� $per_page ������
    $m = 1; // ������ $pages �������
    echo '�������� :';
    if ($_GET[$begin] != 0) echo "\t\t\t" . '<a href="' . noRepeatGet(array($begin => 0, $end => $per_page)) . '"> << </a>' . "\n"; // ������ ��������
    if (isset($_GET[$begin]) && $_GET[$begin] > (($per_page*$pages)/2)){ // ���� ��� ������� �����-�� �������� �� ����������, ������ 10 ����� ���� ��������, � 10 ����� �������
      $j = round($_GET[$begin]-($pages/2)*$per_page)-$per_page;
      $i = round(($_GET[$begin]/$per_page)-($pages/2));
    }
    while ($count > 0 && $j < $count1){
      if ($_GET[$begin] == $j) echo "\t\t\t" . '<b>' . $i . '</b>&nbsp;' . "\n"; //������� ������� ����� ��������
      else echo "\t\t\t" . '<a href="' . noRepeatGet(array($begin => $j, $end => $per_page)) . '">' . $i . '&nbsp;</a>' . "\n";
      $count-=$per_page;
      $j+=$per_page;
      $i++;
      $m++;
      if ($m > $pages){
		  $j = $count2-$per_page;
		  $jFold = $j % $per_page;
		  if ($jFold != 0) $j = $j + ($per_page - $jFold); // ������� ������� �� ����� �������� $per_page, ����� ��������� �� ������� � �������
		  echo "\t\t\t" . '<a href="' . noRepeatGet(array($begin => $j, $end => $per_page)) . '"> >> </a>' . "\n"; // ��������� ��������
		  break;
      }
    }
  }
}

?>