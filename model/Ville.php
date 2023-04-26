<?php

class Ville
{
  private $idVille;
  private $nomVille;
  private $CodeVille;
  private $CodeInsee;
  private $idDepartement;

  function __construct($idVille, $nomVille, $CodeInsee, $CodeVille, $idDepartement)
  {
    $this->idVille = $idVille;
    $this->CodeVille = $CodeVille;
    $this->nomVille = $nomVille;
    $this->CodeInsee = $CodeInsee;
    $this->idDepartement = $idDepartement;
  }

  /**
   * Get the value of idVille
   */
  public function getIdVille()
  {
    return $this->idVille;
  }

  /**
   * Set the value of idVille
   *
   * @return self
   */
  public function setIdVille($idVille)
  {
    $this->idVille = $idVille;
    return $this;
  }

  /**
   * Get the value of nomVille
   */
  public function getNomVille()
  {
    return $this->nomVille;
  }

  /**
   * Set the value of nomVille
   *
   * @return self
   */
  public function setNomVille($nomVille)
  {
    $this->nomVille = $nomVille;
    return $this;
  }

  /**
   * Get the value of CodeVille
   */
  public function getCodeVille()
  {
    return $this->CodeVille;
  }

  /**
   * Set the value of CodeVille
   *
   * @return self
   */
  public function setCodeVille($CodeVille)
  {
    $this->CodeVille = $CodeVille;
    return $this;
  }

  /**
   * Get the value of CodeInsee
   */
  public function getCodeInsee()
  {
    return $this->CodeInsee;
  }

  /**
   * Set the value of CodeInsee
   *
   * @return self
   */
  public function setCodeInsee($CodeInsee)
  {
    $this->CodeInsee = $CodeInsee;
    return $this;
  }

  /**
   * Get the value of idDepartement
   */
  public function getIdDepartement()
  {
    return $this->idDepartement;
  }

  /**
   * Set the value of idDepartement
   *
   * @return self
   */
  public function setIdDepartement($idDepartement)
  {
    $this->idDepartement = $idDepartement;
    return $this;
  }

  public static function GetVilleByIdDepartement($valeur)
  {
    $connexion = new Database;
    $maBase = $connexion->connexion();

    $query = "SELECT * FROM ville WHERE id_departement = '" . $valeur . "'";
    $results = $maBase->prepare($query);
    $results->execute();
    //var_dump($results->fetchAll(PDO::FETCH_ASSOC));
?>

    <option value disabled selected>Sélectionnez une ville</option>

    <?php
    foreach ($results as $ville) {
    ?>
      <option value="<?php echo $ville["id_ville"]; ?>"><?php echo $ville["nom_ville"]; ?></option>
<?php
    }
  }
}
