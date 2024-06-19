<div class="footer">
    <div class="footer-contact">
        Neem contact met ons op: <br><br>
        <?php
        $sql = "SELECT info_tekst FROM informatie WHERE info_type = 1";
        $liqry = $con->prepare($sql);
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_result($info_tekst);
            if ($liqry->execute()) {
                $liqry->store_result();
                while ($liqry->fetch()) {
                    echo $info_tekst . "<br>";
                }
            }
            $liqry->close();
        }
        ?>
    </div>
    <div class="footer-dagen">
    Onze Openings tijden: <br><br>
        <?php
        $sql = "SELECT info_tekst FROM informatie WHERE info_type = 2";
        $liqry = $con->prepare($sql);
        if ($liqry === false) {
            echo mysqli_error($con);
        } else {
            $liqry->bind_result($info_tekst);
            if ($liqry->execute()) {
                $liqry->store_result();
                while ($liqry->fetch()) {
                    echo $info_tekst . "<br>";
                }
            }
            $liqry->close();
        }
        ?>
    </div>
    <div class="d"></div>
</div>
<!-- <div class="footer">
    <div class="footer-contact">Tel: +31 6 12 34 56 78 <br> Sms: 06 00 00 00 00 <br> email: HendrikHogendijk@klantopdract.glu.nl</div>
    <div class="footer-dagen">Onze Openings tijden: <br><br> Maandag - vrijdag: 07.00 - 17.00 uur <br> Zaterdag: Op
        afspraak <br> Zondag: Gesloten
    </div>
</div> -->
<script src="<?= BASEURL; ?>assets/js/slideshow.js"></script>
</body>
<script></script>

</html>