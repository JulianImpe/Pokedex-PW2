<?php
echo '<link rel="stylesheet" href="styles/footer.css">';
echo '<footer id="footer">';
echo '<div class="w3-row-padding">';

echo '<div class="w3-col">';
echo '<h4>Acerca de</h4>';
echo '<p><a href="#">About us</a></p>';
echo '<p><a href="#">Support</a></p>';

echo '<p><a href="#">Gift card</a></p>';
echo '<p><a href="#">Help</a></p>';
echo '</div>';


echo '<div class="w3-col">';
echo '<h4>¡Registrate para recibir correros de Pokemon!</h4>';
echo '<p></p>';
echo '<form action="/action_page.php" target="_blank">';
echo '<p><input type="text" placeholder="Name" name="Name" required></p>';
echo '<p><input type="text" placeholder="Email" name="Email" required></p>';
echo '<button type="submit">Send</button>';
echo '</form>';
echo '</div>';

echo '<div class="w3-col w3-justify">';
echo '<h4>Tienda</h4>';
echo '<p><i class="fa fa-fw fa-map-marker"></i> The Pokemon Company</p>';
echo '<p><i class="fa fa-fw fa-phone"></i> 0044123123</p>';
echo '<p><i class="fa fa-fw fa-envelope"></i> example@mail.com</p>';

echo '<i class="fa fa-facebook-official"></i>';
echo '<i class="fa fa-instagram"></i>';
echo '<i class="fa fa-snapchat"></i>';
echo '<i class="fa fa-pinterest-p"></i>';
echo '<i class="fa fa-twitter"></i>';
echo '<i class="fa fa-linkedin"></i>';
echo '</div>';

echo '</div>'; // w3-row-padding
echo '</footer>';
?>
