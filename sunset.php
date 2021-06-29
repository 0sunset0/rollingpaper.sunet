<?php
$conn = mysqli_connect("localhost", "root", "sun0896180");
mysqli_select_db($conn, "opentutorials2");
$result = mysqli_query($conn, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="http://localhost/rolling/style.css">
      <link rel="stylesheet" type="text/css" href="http://localhost/rolling/text.js">
  </head>
  <body>
    <header>
      <h1><a href="http://localhost/rolling/sunset.php">SUNSET PAPER!</h1></a>
    </header>
    <div class="info">
    <form action="http://localhost/rolling/process.php" method="POST" >
      <p>
        노을에게 롤링페이퍼를 써주세요! <?php echo "<br><br>"; ?>
        별명 <?php echo "<br>"; ?>
        <input type="text" name="author">

      </p>
      <p>
        내용
        <?php echo "<br>"; ?>
        <textarea name="description" onKeyUp="javascript:fnChkByte(this,'200')"></textarea>
        <span id="byteInfo">0</span> 200bytes
        <script type="text/javascript">
          function fnChkByte(obj, maxByte)
          {
            var str = obj.value;
            var str_len = str.length;


            var rbyte = 0;
            var rlen = 0;
            var one_char = "";
            var str2 = "";


            for(var i=0; i<str_len; i++)
            {
              one_char = str.charAt(i);
              if(escape(one_char).length > 4)
              {
                rbyte += 2;                                         //한글2Byte
              }
              else
              {
                rbyte++;                                            //영문 등 나머지 1Byte
              }


              if(rbyte <= maxByte)
              {
                rlen = i+1;                                          //return할 문자열 갯수
              }
            }


            if(rbyte > maxByte)
            {
              // alert("한글 "+(maxByte/2)+"자 / 영문 "+maxByte+"자를 초과 입력할 수 없습니다.");
              alert("메세지는 최대 " + maxByte + "byte를 초과할 수 없습니다.")
              str2 = str.substr(0,rlen);                                  //문자열 자르기
              obj.value = str2;
              fnChkByte(obj, maxByte);
            }
            else
            {
              document.getElementById('byteInfo').innerText = rbyte;
            }
          }
        </script>
      </p>
      <input type="submit" name="" value="완료">
    </form>
    </div>
    <article>
      <!-- 롤링페이퍼 내용이 보임 -->
      <?php
        $sql = "SELECT * FROM user" ;
        $result = mysqli_query($conn, $sql);
          while( $row = mysqli_fetch_assoc($result)){?>
            <div class="image">
                <img src="https://cdn.pixabay.com/photo/2017/03/18/17/39/notepad-2154572_960_720.png" >
            <div class="content">
            <?php echo htmlspecialchars($row['author']." : "); //텍스트
            echo htmlspecialchars($row['description']);
              ?></div></div>
              <!-- <form action="http://localhost/rolling/process2.php" method="post" >
               노을 : <textarea name="comment"></textarea>
               <input type="submit" >
              </form></div></div> -->
            <?php
          }
          ?>
    </article>
  </body>
</html>
