let candidatures = [];
let idcount = 1;

function ajouteCandidature(name,age,projet){
    candidatures.push({
        id : idcount++,
        name:name,
        age : age,
        projet : projet,
        status:"en attente"
    });
   }


function afficherToutesLesCandidatures(){
   console.log(candidatures);
}


function validerCandidature(id){

    candidatures.forEach(candidate =>{
        if(candidate.id == id){
           candidate.status = "Valider"
        }
    });
}

function rejeterCandidature(id){

    candidatures.forEach(candidate =>{
        if(candidate.id == id){
           candidate.status = "Reuinon de cadrage hhhhh"
        }
    });
}




function rechercherCandidat(name){
    candidatures.forEach(candidate=>{
        if(candidate.name === name){
            console.log(candidate);
        }
    })
}

function filtrerParStatut(status){
    candidatures.forEach(candidate =>{
        if(candidate.status === status){
           console.log(candidate);
        }
    })
}


function statistiques(){

    console.log(`Total des candidats: ${candidatures.length}`);

    let enAttente = candidatures.filter(c => c.status === "en attente").length;
    let valides = candidatures.filter(c => c.status === "Valider").length;
    let rejetes = candidatures.filter(c => c.status === "Reuinon de cadrage hhhhh").length;

    console.log(`Candidats en attente: ${enAttente}`);
    console.log(`Candidats validés: ${valides}`);
    console.log(`Candidats rejetés: ${rejetes}`);

}
ajouteCandidature('mohamed',19,'طبخ مغربي');
ajouteCandidature('hhhh',10,'slak ajmi');
ajouteCandidature('Imsail',23,'non');
ajouteCandidature('Hmed',80,'ah');
// validerCandidature(2);
// validerCandidature(3);
// rejeterCandidature(1)
// afficherToutesLesCandidatures();
// rechercherCandidat('ismail');
// filtrerParStatut('Valider')
statistiques();