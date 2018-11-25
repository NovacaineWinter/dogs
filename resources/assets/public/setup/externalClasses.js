export default  class Errors {

    constructor() {
        this.errors = {};
    }

    get(field){
        if(this.errors[field]) {
            return  'This field is required'; //this.errors[field][0];
        }
    }

    record(errors) {
        this.errors = errors;
    }

    clear(field) {
        delete this.errors[field];
    }

    has(field) {
        if(this.errors[field]) {
            return  true;
        }else{
            return false;
        }
    }

    any() {

        return Object.keys(this.errors).length > 0;

    }
}