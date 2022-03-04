import {Controller} from "@hotwired/stimulus";
import { Modal } from 'bootstrap';
import $ from 'jquery';

export default class extends Controller {
  static values = {
    id: String,
    detailUrl: String,
  };

  showDetails(event) {
    const modal = new Modal(document.getElementById('modal_global'));
    modal.show();

    $.ajax(this.detailUrlValue)
      .done(function (data) {
        console.log(data);
        $('#modal_global .modal-body').html(data);
      })
      .fail(function (jqXHR, textStatus, errorThrown) {
        $('#modal_global .modal-body').html('ERROR');
      });
  }
}
