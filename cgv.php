<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>0Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/header.css">
    <link rel="stylesheet" href="assets/login.css">
    <link rel="stylesheet" href="assets/formsignin.css"> 
    <link rel="stylesheet" href="assets/footer.css">
    <link rel="stylesheet" href="assets/primary.css">
  </head>
  <body>
        <?php   
            require_once "./composent/template/header.php";
            function mainnoauth(){
              require_once "./composent/main/signinform.php";
              require_once "./composent/main/loginclient.php";
            }
            if (isset($_SESSION['token'])){ 
              list($key , $keya, $firstnameencode, $typeencode, $keyb, $lastnameencode, $usernameencode) = explode("@",$_SESSION['token']);
              if (base64_decode($typeencode) == "client") { 
              }
              elseif (base64_decode($typeencode) == "banker") {
              }
              elseif (base64_decode($typeencode) == "waiting") {
              }
              else {
                mainnoauth();
              }
            }else {
              mainnoauth();
            }
              
        ?>
        <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10" id="main">
<h1>Conditions générales de vente de prestations de services en ligne à des consommateurs particuliers</h1>
 
 
 
<h3>Préambule</h3> 
 
Les présentes conditions générales de vente s'appliquent à toutes les prestations de services conclues sur le site Internet zbank.zbank.<br>
Le site Internet zbank.snag.studio est un service de :<br>
- la société ZEROBANK<br>
- située à : 19 rue des pepettes dans la poche<br>
- adresse URL du site : https://zbank.snag.studio/<br>
- adresse mail : zerobank@zbank.tech<br>
- téléphone : 0666666666<br>
Le client déclare avoir pris connaissance et avoir accepté les conditions générales de vente antérieurement à la passation de la commande. La validation de la commande vaut donc acceptation des conditions générales de vente.<br>
 
<h3>Article 1 - Contenu et champ d'application</h3>

Les présentes conditions générales de vente s'appliquent de plein droit aux prestations de services suivantes : Banque en ligne.<br>
Elles s'appliquent à l'exclusion de toutes autres conditions, et notamment celles applicables pour les ventes sur internet ou au moyen d'autres circuits de distribution et de commercialisation.<br>
La vente est réputée conclue à la date d'acceptation de la commande ou à l'achat immédiat par le vendeur.<br>
Toute commande ou achat immédiat implique l'adhésion sans réserve aux présentes conditions générales de vente qui prévalent sur toutes autres conditions, à l'exception de celles qui ont été acceptées expressément par le vendeur.<br>
L'acheteur déclare avoir pris connaissance des présentes conditions générales de vente et les avoir acceptées avant son achat immédiat ou la passation de sa commande.<br>

<h3>Article 2 - Informations précontractuelles</h3>

Préalablement à l'achat immédiat ou à la passation de la commande et à la conclusion du contrat, ces conditions générales de vente sont communiquées à l'acheteur, qui reconnaît les avoir reçues.<br>
Sont transmises à l'acheteur, de manière claire et compréhensible, les informations suivantes :<br>
- les caractéristiques essentielles du service ;<br>
- le prix du service ou le mode de calcul du prix et, s'il y a lieu, tous les frais supplémentaires de transport, de livraison ou d'affranchissement et tous les autres frais éventuels ;<br>
- la date ou le délai auquel le prestataire s'engage à exécuter le service, quel que soit son prix, et toute autre condition contractuelle ;<br>
- les informations relatives à l'identité du prestataire, à ses coordonnées postales, téléphoniques et électroniques, et à ses activités ;<br>
- les modalités prévues pour le traitement des réclamations ;<br>
- la durée du contrat, lorsqu'il est conclu à durée déterminée, ou les conditions de sa résiliation en cas de contrat à durée indéterminée ;<br>
- en ce qui concerne le contenu numérique toute interopérabilité pertinente de ce contenu avec certains matériels ou logiciels dont le professionnel a ou devrait raisonnablement avoir connaissance.<br>
 
Le prestataire de services doit également communiquer à l'acheteur, ou mettre à sa disposition, les informations suivantes :<br>
- statut et forme juridique, coordonnées permettant d'entrer en contact rapidement et de communiquer directement avec lui ;<br>
- le cas échéant, le numéro d'inscription au registre du commerce et des sociétés ou au répertoire des métiers ;<br>
- pour les activités soumises à un régime d'autorisation, le nom et l'adresse de l'autorité l'ayant délivrée ;<br>
- pour le prestataire assujetti à la taxe sur la valeur ajoutée et identifié par un numéro individuel en application de l'article 286 ter du code général des impôts, son numéro individuel d'identification ;<br>
- pour le prestataire membre d'une profession réglementée, son titre professionnel, l'État membre de l'UE dans lequel il a été octroyé ainsi que le nom de l'ordre ou de l'organisme professionnel auprès duquel il est inscrit ;<br>
- l'éventuelle garantie financière ou assurance de responsabilité professionnelle souscrite par lui, les coordonnées de l'assureur ou du garant ainsi que la couverture géographique du contrat ou de l'engagement.<br>
 
<h3>Article 3 - Commande</h3>

Par commande, il faut entendre tout ordre portant sur les prestations figurant sur les tarifs du vendeur, et accepté par lui, accompagné du paiement de l'acompte éventuellement prévu sur le bon de commande.<br>
Toute commande, pour être valable, doit être établie sur les bons de commande du vendeur, à la disposition de la clientèle dans ses magasins.<br>
Toute commande parvenue au vendeur est réputée ferme et définitive.<br>
Elle entraîne adhésion et acceptation pleine et entière des présentes conditions générales de vente et obligation de paiement des produits commandés.<br>
L'acheteur dispose d'un droit de rétractation de 14 jours à compter de la conclusion du contrat, sauf exception prévue par l'article L.211-28 du Code de la consommation.<br>

<h3>Article 4 - Devis</h3>

Pour les services donnant lieu à l'établissement d'un devis préalable, la vente ne sera considérée comme définitive qu'après établissement d'un devis par le prestataire et envoi à l'acheteur de la confirmation de l'acceptation de la commande.<br>
Les devis établis par le prestataire ont une durée de validité de 10 Jours.<br>
 
<h3>Article 5 - Exécution de la prestation et résolution du contrat</h3>

Sauf conditions particulières expresses propres à la vente, l'exécution de la prestation s'effectuera dans le délai de immédiat à compter de la réception par le vendeur d'une commande en bonne et due forme.<br>
En cas de manquement du vendeur à son obligation d'exécution à la date ou à l'expiration du délai prévu ci-dessus, ou, à défaut, au plus tard 30 jours après la conclusion du contrat, l'acheteur peut résoudre le contrat, dans les conditions des articles L. 216-2 et L. 216-3 et L. 216-4 du code de la consommation, par lettre recommandée avec demande d'avis de réception ou par un écrit sur un autre support durable, si, après avoir enjoint, selon les mêmes modalités, le professionnel de fournir le service dans un délai supplémentaire raisonnable, ce dernier ne s'est pas exécuté dans ce délai.<br>
Le contrat est considéré comme résolu à la réception par le professionnel de la lettre ou de l'écrit l'informant de cette résolution, à moins que le professionnel ne se soit exécuté entre-temps.<br>
Néanmoins, l'acheteur peut immédiatement résoudre le contrat lorsque le professionnel refuse de fournir le service ou lorsqu'il n'exécute pas son obligation de fourniture du service à la date prévue, si cette date ou ce délai constitue pour l'acheteur une condition essentielle du contrat. Cette condition essentielle résulte des circonstances qui entourent la conclusion du contrat ou d'une demande expresse du consommateur avant la conclusion du contrat.<br>
Les frais et les risques liés à cette opération sont à la charge exclusive du prestataire.<br>
Hormis cas de force majeure, l'acompte versé à la commande est acquis de plein droit et ne peut donner lieu à aucun remboursement.<br>
 
<h3>Article 6- Exceptions au délai de rétractation</h3>
 
Le délai de rétractation de 14 jours ne concerne pas la ou les situations ci-dessous énumérées:<br>
- La prestation est effectuée (ou a commencé) avant la fin du délai de rétractation, après accord préalable exprès du consommateur et renoncement exprès à son droit de rétractation.<br>
- Le prix de la prestation de services dépend de fluctuations du marché. <br>
 
 
 
<h3>Article 7 - Prix</h3>

Les prix sont fermes et définitifs. Sauf conditions particulières expresses propres à la vente, les prix des prestations effectuées sont ceux figurant dans le catalogue des prix au jour de la commande.<br>
Ils sont exprimés en monnaie légale et stipulés toutes taxes comprises.<br>
S'ajoutent à ces prix les frais suivants : Agios / frais / money money money, dans les conditions indiquées sur le catalogue tarifaire du prestataire.<br>
 
<h3>Article 8 - Paiement</h3>
 
Le paiement intervient dans un délai de Tous les mois / 79euros à compter de la date de réalisation de la prestation.<br>
Une somme payée d'avance calculée selon les modalités suivantes : 3000 euros, est exigée lors de la passation de la commande par l'acheteur. Sauf stipulation contraire, pour tout contrat de vente ou de prestation de services conclu entre un professionnel et un consommateur, les sommes versées d'avance sont des arrhes, au sens de l'article 1590 du code civil. <br>
Dans ce cas, chacun des contractants peut revenir sur son engagement, le consommateur en perdant les arrhes, le professionnel en les restituant au double.<br>
Les paiements effectués par l'acheteur ne seront considérés comme définitifs qu'après encaissement effectif des sommes dues par le prestataire.<br>
Une facture sera remise à l'acheteur sur simple demande.<br>
 
<h3>Article 9 - Garanties - Généralités</h3>
 
<h4>9-1 Garantie légale de conformité</h4>
ZEROBANK est garant de la conformité du bien vendu au contrat, permettant à l'acheteur de formuler une demande au titre de la garantie légale de conformité prévue aux articles L. 217-4 et suivants du code de la consommation.<br>
En cas de mise en oeuvre de la garantie légale de conformité, il est rappelé que :<br>
-  l'acheteur bénéficie d'un délai de 2 ans à compter de la délivrance du bien pour agir ;<br>
-  l'acheteur peut choisir entre la réparation ou le remplacement du bien, sous réserve des conditions de coût prévues par l'article L. 217-17 du code de la consommation ;<br>
-  l'acheteur n’a pas à apporter la preuve de la non-conformité du bien durant les 24 mois en cas de biens neufs (6 mois en cas de biens d'occasion), suivant la délivrance du bien.<br>
 
<h4>9-2 Garantie légales des vices cachés</h4>
Conformément aux articles 1641 et suivants du code civil, ZEROBANK est garant des vices cachés pouvant affecter le bien vendu. Il appartiendra à l'acheteur de prouver que les vices existaient à la vente du bien et sont de nature à rendre le bien impropre à l'usage auquel il est destiné. Cette garantie doit être mise en oeuvre dans un délai de deux ans à compter de la découverte du vice. <br>
L'acheteur peut choisir entre la résolution de la vente ou une réduction du prix conformément à l'article 1644 du code civil.<br>

<h3>Article 10 - Propriété intellectuelle</h3>
 
Tous les documents techniques, produits, dessins, photographies remis aux acheteurs demeurent la propriété exclusive de ZEROBANK, seul titulaire des droits de propriété intellectuelle sur ces documents, et doivent lui être rendus à sa demande.<br>
Les acheteurs clients s'engagent à ne faire aucun usage de ces documents, susceptible de porter atteinte aux droits de propriété industrielle ou intellectuelle du fournisseur et s'engagent à ne les divulguer à aucun tiers.<br>

<h3>Article 11 - Juridiction compétente</h3>
 
Tous les litiges auxquels les opérations d'achat et de vente conclues en application des présentes conditions générales de vente pourraient donner lieu, concernant tant leur validité, leur interprétation, leur exécution, leur résiliation, leurs conséquences et leurs suites et qui n'auraient pas pu être résolus à l'amiable entre le vendeur et le client, seront soumis aux tribunaux compétents dans les conditions de droit commun.<br>
Pour la définition de la juridiction compétente, le vendeur élit domicile à 19 rue des pepettes dans la poche.<br>

<h3>Article 12 - Langue du contrat</h3>
 
Les présentes conditions générales de vente sont rédigées en langue française. Dans le cas où elles seraient traduites en une ou plusieurs langues étrangères, seul le texte français ferait foi en cas de litige.<br>

<h3>Article 13 - Médiation et règlement des litiges</h3>
 
L'acheteur peut recourir à une médiation conventionnelle, notamment auprès de la Commission de la médiation de la consommation ou auprès des instances de médiation sectorielles existantes, ou à tout mode alternatif de règlement des différends (conciliation, par exemple) en cas de contestation. <br>
En cas de contestation, les coordonnées du médiateur auquel l'acheteur peut s'adresser sont les suivantes : Aucun, aucun, debrouiller vous avec nous, 00666, jaipasletemps@mediarien.fr.<br>
 
Conformément à l’article 14 du Règlement (UE) n°524/2013, la Commission Européenne a mis en place une plateforme de Règlement en Ligne des Litiges, facilitant le règlement indépendant par voie extrajudiciaire des litiges en ligne entre consommateurs et professionnels de l’Union européenne. Cette plateforme est accessible au lien suivant : https://webgate.ec.europa.eu/odr/.<br>
 
<h3>Article 14 - Loi applicable</h3>
 
<br>Les présentes conditions générales sont soumises à l'application du droit français. 
<br>Il en est ainsi pour les règles de fond comme pour les règles de forme. En cas de litige ou de réclamation, l'acheteur s'adressera en priorité au vendeur pour obtenir une solution amiable.
 
<h3>Article 15 - Protection des données personnelles</h3>
 
<br><h4>Données collectées :</h4>
<br>Les données à caractère personnel qui sont collectées sur ce site sont les suivantes :
<br>- ouverture de compte : lors de la création du compte de l'utilisateur, ses nom ; prénom ; adresse électronique ; n° de téléphone ; adresse postale ; date de naissance et pièces d'identité
<br>- connexion : lors de la connexion de l'utilisateur au site web, celui-ci enregistre, notamment, ses nom, prénom, données de connexion, d'utilisation, de localisation et ses données relatives au paiement ;
<br>- profil : l'utilisation des prestations prévues sur le site web permet de renseigner un profil, pouvant comprendre une adresse et un numéro de téléphone ;
<br>- paiement : dans le cadre du paiement des produits et prestations proposés sur le site web, celui-ci enregistre des données financières relatives au compte bancaire ou à la carte de crédit de l'utilisateur ;
<br>- communication : lorsque le site web est utilisé pour communiquer avec d'autres membres, les données concernant les communications de l'utilisateur font l'objet d'une conservation temporaire ;
<br>- cookies : les cookies sont utilisés, dans le cadre de l'utilisation du site. L'utilisateur a la possibilité de désactiver les cookies à partir des paramètres de son navigateur.
 
<br><h4>Utilisation des données personnelles</h4>
<br>Les données personnelles collectées auprès des utilisateurs ont pour objectif la mise à disposition des services du site web, leur amélioration et le maintien d'un environnement sécurisé. Plus précisément, les utilisations sont les suivantes :
<br>-  accès et utilisation du site web par l'utilisateur ;
<br>-  gestion du fonctionnement et optimisation du site web ;
<br>-  organisation des conditions d'utilisation des Services de paiement ;
<br>-  vérification, identification et authentification des données transmises par l'utilisateur ;
<br>-  proposition à l'utilisateur de la possibilité de communiquer avec d'autres utilisateurs du site web ;
<br>-  mise en oeuvre d'une assistance utilisateurs ;
<br>-  personnalisation des services en affichant des publicités en fonction de l'historique de navigation de l'utilisateur, selon ses préférences ;
<br>-  prévention et détection des fraudes, malwares (malicious softwares ou logiciels malveillants) et gestion des incidents de sécurité ;
<br>-  gestion des éventuels litiges avec les utilisateurs ;
<br>-  envoi d'informations commerciales et publicitaires, en fonction des préférences de l'utilisateur.

<br><h4>Partage des données personnelles avec des tiers</h4>
<br>Les données personnelles peuvent être partagées avec des sociétés tierces, dans les cas suivants :
<br>-  quand l'utilisateur utilise les services de paiement, pour la mise en oeuvre de ces services, le site web est en relation avec des sociétés bancaires et financières tierces avec lesquelles elle a passé des contrats ;
<br>-  lorsque l'utilisateur publie, dans les zones de commentaires libres du site web, des informations accessibles au public ;
<br>-  quand l'utilisateur autorise le site web d'un tiers à accéder à ses données ;
<br>-  quand le site web recourt aux services de prestataires pour fournir l'assistance utilisateurs, la publicité et les services de paiement. Ces prestataires disposent d'un accès limité aux données de l'utilisateur, dans le cadre de l'exécution de ces prestations, et ont une obligation contractuelle de les utiliser en conformité avec les dispositions de la réglementation applicable en matière protection des données à caractère personnel ;
<br>-  si la loi l'exige, le site web peut effectuer la transmission de données pour donner suite aux réclamations présentées contre le site web et se conformer aux procédures administratives et judiciaires ;
<br>-  si le site web est impliquée dans une opération de fusion, acquisition, cession d'actifs ou procédure de redressement judiciaire, elle pourra être amenée à céder ou partager tout ou partie de ses actifs, y compris les données à caractère personnel. Dans ce cas, les utilisateurs seraient informés, avant que les données à caractère personnel ne soient transférées à une tierce partie.

<br><h4>Sécurité et confidentialité</h4>
<br>Le site web met en oeuvre des mesures organisationnelles, techniques, logicielles et physiques en matière de sécurité du numérique pour protéger les données personnelles contre les altérations, destructions et accès non autorisés. Toutefois, il est à signaler qu'internet n'est pas un environnement complètement sécurisé et le site web ne peut pas garantir la sécurité de la transmission ou du stockage des informations sur internet.

<br><h4>Mise en oeuvre des droits des utilisateurs</h4>
<br>En application de la réglementation applicable aux données à caractère personnel, les utilisateurs disposent des droits ci-dessous mentionnés, qu'ils peuvent exercer en faisant leur demande à l'adresse suivante : zerobank@snage.tech
<br>· Le droit d’accès : ils peuvent exercer leur droit d'accès, pour connaître les données personnelles les concernant. Dans ce cas, avant la mise en œuvre de ce droit, le site web peut demander une preuve de l'identité de l'utilisateur afin d'en vérifier l'exactitude. 
<br>· Le droit de rectification : si les données à caractère personnel détenues par le site web sont inexactes, ils peuvent demander la mise à jour des informations.
<br>· Le droit de suppression des données : les utilisateurs peuvent demander la suppression de leurs données à caractère personnel, conformément aux lois applicables en matière de protection des données. 
<br>· Le droit à la limitation du traitement : les utilisateurs peuvent de demander au site web de limiter le traitement des données personnelles conformément aux hypothèses prévues par le RGPD. 
<br>· Le droit de s’opposer au traitement des données : les utilisateurs peuvent s’opposer à ce que ses données soient traitées conformément aux hypothèses prévues par le RGPD.  
<br>· Le droit à la portabilité : ils peuvent réclamer que le site web leur remette les données personnelles qui lui sont fournies pour les transmettre à un nouveau site web.
<br>Evolution de la présente clause
<br>Le site web se réserve le droit d'apporter toute modification à la présente clause relative à la protection des données à caractère personnel à tout moment. Si une modification est apportée à la présente clause de protection des données à caractère personnel, le site web s'engage à publier la nouvelle version sur son site. Le site web informera également les utilisateurs de la modification par messagerie électronique, dans un délai minimum de 15 jours avant la date d'effet. Si l'utilisateur n'est pas d'accord avec les termes de la nouvelle rédaction de la clause de protection des données à caractère personnel, il a la possibilité de supprimer son compte.
 

<h3>Annexe </h3>
 
<h3>Formulaire de rétractation </h3>
<br>(à compléter par le consommateur,
<br>et à envoyer par lettre recommandée avec accusé de réception,
<br>dans le délai maximum de 14 jours suivant la date de conclusion du contrat de prestation)
 
 
<br><h4>Formulaire de rétractation</h4>
 
<br>À l'attention de :
<br>ZEROBANK,
<br>situé à 19 rue des pepettes dans la poche, 
<br>n° de téléphone : 0666666666, 
<br>adresse mél : zerobank@snage.tech.
 
<br>Je vous notifie, par la présente, ma rétractation du contrat portant sur la prestation de service, commandée le :  .........
 
<br>Prénom et nom du consommateur : .................
<br>Adresse du consommateur : .................
 
<br>Date : ..................
 
<br>Signature du consommateur :
<br><br><br><br>
</div>
            <div class="col-md-1"></div>
        </div>
    </div>
    
    <?php
  require_once "./composent/template/footer.php";
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
<script src="./script.js"></script>
 </body>
</html>
z