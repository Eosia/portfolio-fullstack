export class Realisation {
    id: number;
    titre: string;
    lien: string;
    image: string;
    order: number;


    constructor(id: number, titre: string, lien: string, image: string) {
        this.id = id;
        this.titre = titre;
        this.lien = lien;
        this.image = image;
    }
}
