import {Controller} from "@hotwired/stimulus";
import { Modal } from 'bootstrap';

export default class extends Controller {
  static values = {
    id: String,
  };

  static targets = ['modal'];

  showDetails(event) {
    console.log(this.idValue)
    const modal = new Modal(document.getElementById('modal_global'));
    modal.show();
  }
}
