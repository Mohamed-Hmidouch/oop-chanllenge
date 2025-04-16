<?php

interface ReservableInterface
{
    public function reserver(Client $client,DateTime $dateDebut, int $nbJours): Reservation;
}

abstract class Vechicule
{

    private $id;
    private $immatriculation;
    private $marque;
    private $model;
    private $prixJour;
    private $disponible;


    public function __construct(string $immatriculation, string $marque, string $model, float $prixJour, bool $disponible)
    {
        $this->immatriculation = $immatriculation;
        $this->marque = $marque;
        $this->model = $model;
        $this->prixJour = $prixJour;
        $this->disponible = $disponible;
    }

    abstract function __getType();
    public function afficherDetails(){}
    public function calculerPrix(){}
    public function estDisponible(){}
}

class Voiture implements ReservableInterface
{
    private $nbPortes;
    private $transmission;


    public  function __construct(int $nbPortes,string $transmission)
    {
        $this->nbPortes = $nbPortes;
        $this->transmission = $transmission;
    }

    public function __getType()
    {
        return "Voiture";
    }

    public function afficherDetails()
    {
      return "Marque : $this->marque, Model : $this->model, Immatriculation : $this->immatriculation, Prix par jour : $this->prixJour, Nombre de portes : $this->nbPortes, Transmission : $this->transmission";
    }

    public function reserver(Client $client, DateTime $dateDebut, int $nbJours):Reservation
    {
        return new Reservation($client, $dateDebut, $nbJours);
    }

}


class Moto implements ReservableInterface
{
    private $cylindree;


    public function __getType()
    {
        return "Moto";
    }

    public function afficherDetails()
    {
      return "Marque : $this->marque, Model : $this->model, Immatriculation : $this->immatriculation, Prix par jour : $this->prixJour, Cylindrée : $this->cylindree";
    }

    public function reserver(Client $client, DateTime $dateDebut, int $nbJours):Reservation
    {
        return new Reservation($client, $dateDebut, $nbJours);

    }

}


class Camion implements ReservableInterface
{
    private $capaciteTonnage;


    public function __getType()
    {
      return "Camion";
    }

    public function afficherDetails()
    {
       return "Marque : $this->marque, Model : $this->model, Immatriculation : $this->immatriculation, Prix par jour : $this->prixJour, Capacité de tonnage : $this->capaciteTonnage";
    }

    function reserver(Client $client, DateTime $dateDebut, int $nbJours): Reservation
    {
        return new Reservation($client, $dateDebut, $nbJours);
    }

}


abstract class Personne
{
    protected $nom;
    protected $pernom;
    protected $email;


    public function __construct(string $nom, string $pernom, string $email)
    {
        $this->nom = $nom;
        $this->pernom = $pernom;
        $this->email = $email;
    }
    abstract function afficherProfile();
}

class Client extends Personne
{

    private $numeroClient;
    private $reservations = [];
public function __construct(int $numeroClient, array $reservations)
{
    parent::__construct();
    $this->numeroClient = $numeroClient;
    $this->reservations[] = $reservations;
}
    public function ajouterReservation(Reservation $r){
        $this->reservations[] = $r;
    }
    public function afficherProfile()
    {
        return "Nom : $this->nom, Prenom : $this->pernom, Email : $this->email, Numéro client : $this->numeroClient";
    }

    public function getHistorique(){

    }

}


//////////
class Agence{
    private $nom;
    private $ville;
    private $vechicules = [];
    private $clients = [];


    public function __construct(string $nom, string $ville, array $vechicules, array $clients)
    {
        $this->nom = $nom;
        $this->ville = $ville;
        $this->vechicules = $vechicules;
        $this->clients = $clients;
    }
    public function ajouterVehicule(Vehicule $v)
    {
        $this->vechicules[] = $v;
    }


    public function rechercherVehiculeDisponible(string $type){
        foreach($this->vechicules as $v){
            if($v === $type){
                return $v;
            }
        }
    }


    public function enregistrerClient(Client $c){
         return $this->clients[] = $c;
    }

    public function faireReservation(Client $client, Vehicule $v, DateTime $dateDebut, int $nbJours){
        return $v->reserver($client, $dateDebut, $nbJours);
    }
}


////////////

class Reservation {
    private $vechicule;
    private $client;
    private $dateDebut;
    private $nbJours;
    private $statut;


    public function __construct(Vechicule $vechicule, Client $client, DateTime $dateDebut, int $nbJours, string $statut)
    {
        $this->vechicule = $vechicule;
        $this->client = $client;
        $this->dateDebut = $dateDebut;
        $this->nbJours = $nbJours;
        $this->statut = $statut;
    }
    public function calculerMontant(){
      return $this->dateDebut->diff($this->dateDebut)->days * $this->nbJours;
    }
    public function confirmer(){
        $this->statut = "confirmée";
        $this->client->ajouterReservation($this);
      return "Reservation confirmée";
    }

    public function annuler(){
        $this->statut = "annulée";
       return "reservation annuler";
    }

}

///////

$agenceOne = new Agence('DaHmad agence','Paris',['dacia','clio 4'],['Client Hmad','Client l3arbi']);

$agenceTwo = new Agence('Darbida agence','Casablanca',['citreoun','pikala'],['Client Brahim','Client Hmido dib']);

$agenceOne->ajouterVehicule(new Voiture('1234', 'Renault', 'Clio 4', 50, true));
$agenceOne->ajouterVehicule(new Moto('1111', 'Yamaha', 'MT-07', 30, true));
$agenceOne->ajouterVehicule(new Camion('9100', 'Mercedes', 'Actros', 100, true));

$clientDaHmmad = new Client(1, [],'ahmed');
$clientL3arbi = new Client(2,);