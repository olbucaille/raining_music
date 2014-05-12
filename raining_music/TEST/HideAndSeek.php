

<!DOCTYPE html >
<html>
<head>


<script language="Javascript">
// ==================
//	Activations - Désactivations
// ==================
function GereControle(Controleur, Controle, Masquer) {
var objControleur = document.getElementById(Controleur);
var objControle = document.getElementById(Controle);
	if (Masquer=='1')
		objControle.style.visibility=(objControleur.checked==true)?'visible':'hidden';
	else
		objControle.disabled=(objControleur.checked==true)?false:true;
	return true;
}
</script>
</head><body>
<br /><br /><br /><br />
Exemples de masquage :<br /><br />

<input type="checkbox" id="chkb_10" onClick="GereControle('chkb_10', 'texte_10', '1');" CHECKED>&nbsp;<label for="chkb_10">Contrôle de "texte_10"</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" id="texte_10" value="Contenu de texte_10">

<br /><br />
<input type="radio" id="radio_10" name="radios_0" onClick="GereControle('radio_10', 'liste_10', '1');" CHECKED>&nbsp;<label for="radio_10">Active de "liste_10"</label>
<br />
<input type="radio" id="radio_20" name="radios_0" onClick="GereControle('radio_10', 'liste_10', '1');">&nbsp;<label for="radio_20">Désactive de "liste_10"</label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select id="liste_10">
<option value="1">Ligne 1</option>
<option value="2">Ligne 2</option>
<option value="3">Ligne 3</option>
</select>
<noscript><a href="http://www.editeurjavascript.com/">ajax</a></noscript>


</body>
</html>