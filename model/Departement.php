<?php
class Departement
{
  private $idDepartement;
  private $nomDepartement;
  private $idRegion;

  function __construct($idDepartement, $nomDepartement, $idRegion)
  {
    $this->idDepartement = $idDepartement;
    $this->nomDepartement = $nomDepartement;
    $this->idRegion = $idRegion;
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
   * @return  self
   */
  public function setIdDepartement($idDepartement)
  {
    $this->idDepartement = $idDepartement;
    return $this;
  }
  /**
   * Get the value of nomDepartement
   */
  public function getNomDepartement()
  {
    return $this->nomDepartement;
  }
  /**
   * Set the value of nomDepartement
   *
   * @return  self
   */
  public function setNomDepartement($nomDepartement)
  {
    $this->nomDepartement = $nomDepartement;
    return $this;
  }
  /**
   * Get the value of idRegion
   */
  public function getIdRegion()
  {
    return $this->idRegion;
  }
  /**
   * Set the value of idRegion
   *
   * @return  self
   */
  public function setIdRegion($idRegion)
  {
    $this->idRegion = $idRegion;
    return $this;
  }
  public static function GetDepartementByIdRegion($valeur)
  {
    $connexion = new Database;
    $maBase = $connexion->connexion();
    $query = "SELECT * FROM departement WHERE id_region = :id_region";
    $results = $maBase->prepare($query);
    $results->execute(array(':id_region' => $valeur));
?>
    <option value disabled selected>Sélectionnez un département</option>
    <?php
    foreach ($results as $departement) {
    ?>
      <option value="<?php echo $departement["id_departement"]; ?>"><?php echo $departement["nom_departement"]; ?></option>
<?php
    }
  }
}
?>