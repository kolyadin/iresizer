<?
  
    @$link2 = mysql_connect (":/tmp/mysql-kino.sock", "sky", "uGrs7u8rN"); // ���������� ��������� 
      
    if(!$link2) {
        print " ";
    };

    mysql_select_db("kinoafisha",$link2);


         $tbl_puzz_="newkino_goods_";//  �������� �������
?>