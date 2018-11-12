/**
 * Created by francesco on 20/10/18.
 */
// Room class to define this object's properties.
export class Room {
    constructor(public id: number,
                public name: string,
                public price: number,
                public type: string,
                public persons: number,
                public occupated_from: string,
                public occupated_to: string) {
    }
}