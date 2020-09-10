<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

    /* moduł logi*/
    public function logi() {
        if ( $this->session->userdata('uprawnienia_skaner') > 0 AND $this->session->userdata('logged_in') == TRUE ) {
            $this->load->model("AppModel");

            $data["logi"] = $this->AppModel->select("logi");

            $this->header();
            $this->load->view('app/logi', $data);
            $this->load->view('app/inc/footer');
        } else {
            redirect('App/zalogujSie');
        }
    }
    /* koniec moduł logi*/

    /* modul skaner */
    public function skanerQR() {
        if ( $this->session->userdata('uprawnienia_skaner') > 0 AND $this->session->userdata('logged_in') == TRUE ) {

            $this->header();
            $this->load->view('app/skanerQR');
            $this->load->view('app/inc/footer');
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function szukajKodQR() {
        if ( $this->session->userdata('uprawnienia_katalog') > 0 AND $this->session->userdata('logged_in') == TRUE ) {
            $qr = $this->input->post("qr");

            $this->load->model("AppModel");

            $szukanyQRKod = $this->AppModel->selectWhere("katalog", "qr", $qr );

            redirect("App/czescPopraw/" . $szukanyQRKod[0]->id);

            echo $qr;
            print_r($szukanyQRKod);
        } else {
            redirect('App/zalogujSie');
        }
    }
    /* koniecmodul skaner */

    function header() {
        $this->load->model('AppModel');

        $data["ilosc_pozycji_w_koszyku"] = count( $this->AppModel->selectWhere( "koszyki_pozycje", "uzytkownicy_id", $this->session->userdata('uzytkownik_id') ) );

        $this->load->view('app/inc/header', $data);
    }

    public function index () {
        if ($this->session->userdata('logged_in') == TRUE) {

            $this->header();
            $this->load->view('app/index');
            $this->load->view('app/inc/footer');
        } else {
            redirect('App/zalogujSie');
        }
    }

    /* modul koszyk */
    public function koszykPozycje() {
        if ( $this->session->userdata('logged_in') == TRUE ) {
            $this->load->model('AppModel');

            $data['pozycje'] = $this->AppModel->selectWhere( 'koszyki_pozycje', "uzytkownicy_id", $this->session->userdata('uzytkownik_id') );
            $data['projekty'] = $this->AppModel->select('projekty');

            $this->header();
            $this->load->view('app/koszykPozycje', $data);
            $this->load->view('app/inc/footer');
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function dodajDoKoszyka() {
        if ( $this->session->userdata('logged_in') == TRUE ) {
            $this->load->model('AppModel');

            $id = $this->uri->segment(3);

            $szukana_czesc = $this->AppModel->selectWhere("katalog", "id", $id);

            $nowaPozycjaWkoszyku = array(
                "katalog_id" => $szukana_czesc[0]->id,
                "katalog_nazwa" => $szukana_czesc[0]->nazwa,
                "projekty_id" => $szukana_czesc[0]->projekty_id,
                "katalog_wymagana_ilosc_w_projekcie" => $szukana_czesc[0]->wymagana_ilosc_w_projekcie,
                "uzytkownicy_id" => $this->session->userdata('uzytkownik_id'),
            );
            //dodawanie do bazy
            $this->AppModel->insert("koszyki_pozycje", $nowaPozycjaWkoszyku);
            //przekierowanie
            $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Część dodana do koszyka poprawnie.</div>');
            redirect('App/koszykPozycje/', $wiadomosc_przekierowania);
            refresh();
        }
    }

    public function usunPozycjeZKoszyka() {
        if ( $this->session->userdata('logged_in') == TRUE ) {
            $this->load->model('AppModel');

            $id = $this->uri->segment(3);
            //dodawanie do bazy
            $this->AppModel->deleteWhere("koszyki_pozycje", "id", $id);
            //przekierowanie
            $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Część usunięta poprawnie.</div>');
            redirect('App/koszykPozycje/', $wiadomosc_przekierowania);
            refresh();
        }
    }
    /* koniec modul koszyk */

    /* modul katalog */
    public function szukajCzesci() {
        if ( $this->session->userdata('uprawnienia_katalog') > 0 AND $this->session->userdata('logged_in') == TRUE ) {
            $kategorie_id = $this->input->post("kategorie_id", TRUE);
            $projekty_id = $this->input->post("projekty_id", TRUE);
            redirect("App/katalog/$kategorie_id/$projekty_id");
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function katalog() {
        if ( $this->session->userdata('uprawnienia_katalog') > 0 AND $this->session->userdata('logged_in') == TRUE ) {
            $this->load->model('AppModel');

            //szukanie dla kategorii
            $kategorie_id = $this->uri->segment(3);
            if ( $kategorie_id == "" ) {
                $kategorie_id = 0;
            }

            //szukanie dla projektu
            $projekty_id = $this->uri->segment(4);
            if ( $projekty_id == "" ) {
                $projekty_id = 0;
            }

            $data["kategorie_id"] = $kategorie_id;
            $data["projekty_id"] = $projekty_id;

            $data['katalog'] = "";

            $uzyte_szukanie_katalogu = 0;
            if ( $kategorie_id != 0 AND $projekty_id != 0 AND $uzyte_szukanie_katalogu == 0 ) {
                $data['katalog'] = $this->AppModel->selectWhereWhere('katalog', "kategorie_id", $kategorie_id, "projekty_id", $projekty_id);
                $uzyte_szukanie_katalogu = 1;
            }

            if ( $kategorie_id != 0 AND $projekty_id == 0 AND $uzyte_szukanie_katalogu == 0 ) {
                $data['katalog'] = $this->AppModel->selectWhere('katalog', "kategorie_id", $kategorie_id);
                $uzyte_szukanie_katalogu = 1;
            }

            if ( $kategorie_id == 0 AND $projekty_id != 0 AND $uzyte_szukanie_katalogu == 0 ) {
                $data['katalog'] = $this->AppModel->selectWhere('katalog', "projekty_id", $projekty_id);
                $uzyte_szukanie_katalogu = 1;
            }

            if ( $kategorie_id == 0 AND $projekty_id == 0 AND $uzyte_szukanie_katalogu == 0 ) {
                $data['katalog'] = $this->AppModel->select('katalog');
                $uzyte_szukanie_katalogu = 1;
            }

            $data['statusy'] = $this->AppModel->select('katalog_statusy');
            $data['projekty'] = $this->AppModel->select('projekty');
            $data['kategorie'] = $this->AppModel->select('kategorie');
            
            $this->header();
            $this->load->view('app/katalog/katalog', $data);
            $this->load->view('app/inc/footer');
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function czescDodaj() {
        if ( $this->session->userdata('uprawnienia_katalog') > 1 AND $this->session->userdata('logged_in') == TRUE ) {

            $this->form_validation->set_rules('nazwa', 'nazwa', 'required');
            $this->form_validation->set_rules('qr', 'qr kod', 'required');

            $this->load->model('AppModel');

            if ( $this->form_validation->run() == FALSE ) {

                //generowanie unikalnego kodu by znależć w bazie dodanego pracownika
                $this->load->helper("my_helper");
                $data["qr"] = random_string(16);
                
                while (TRUE) {
                    $szukamyCzyKodIstnieje = $this->AppModel->selectWhere("katalog", "qr", $data["qr"]);
                    
                    if ($szukamyCzyKodIstnieje == NULL) {
                        break;
                    } else {
                        $data["qr"] = random_string(16);
                    }
                }
                //koniec generowanie unikalnego kodu by znależć w bazie dodanego pracownika

                $data['statusy'] = $this->AppModel->select('katalog_statusy');
                $data['projekty'] = $this->AppModel->select('projekty');
                $data['kategorie'] = $this->AppModel->select('kategorie');

                $this->header();
                $this->load->view('app/katalog/czescDodaj', $data);
                $this->load->view('app/inc/footer');
            } else {
                $nowa_czesc = array(
                    "qr" => $this->input->post("qr", TRUE),
                    "nazwa" => $this->input->post("nazwa", TRUE),
                    "sku" => $this->input->post("sku", TRUE),
                    "stan_w_magazynie" => $this->input->post("stan_w_magazynie", TRUE),
                    "kategorie_id" => $this->input->post("kategorie_id", TRUE),
                    "projekty_id" => $this->input->post("projekty_id", TRUE),
                    "wymagana_ilosc_w_projekcie" => $this->input->post("wymagana_ilosc_w_projekcie", TRUE),
                    "katalog_statusy_id" => $this->input->post("katalog_statusy_id", TRUE),
                );
                $this->AppModel->insert("katalog", $nowa_czesc);
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Część dodana poprawnie.</div>');
                redirect('App/katalog/', $wiadomosc_przekierowania);
                refresh();
            }
        
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function drukujKodQR() {
        if ( $this->session->userdata('uprawnienia_katalog') > 0 AND $this->session->userdata('logged_in') == TRUE ) {

            $id = $this->uri->segment(3);

            $this->load->model('AppModel');

            $data['czesc'] = $this->AppModel->selectWhere('katalog', "id", $id);

            $this->load->view('app/katalog/drukujKodQR', $data);
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function czescPopraw() {
        if ( $this->session->userdata('uprawnienia_katalog') > 2 AND $this->session->userdata('logged_in') == TRUE ) {

            $id = $this->uri->segment(3);

            $this->load->model('AppModel');

            $data['czesc'] = $this->AppModel->selectWhere('katalog', "id", $id);
            $data['statusy'] = $this->AppModel->select('katalog_statusy');
            $data['pliki'] = $this->AppModel->selectWhere('katalog_pliki', "katalog_id", $id);
            $data['projekty'] = $this->AppModel->select('projekty');
            $data['kategorie'] = $this->AppModel->select('kategorie');

            $this->header();
            $this->load->view('app/katalog/czescPopraw', $data);
            $this->load->view('app/inc/footer');

        } else {
            redirect('App/zalogujSie');
        }
    }
    public function czescPoprawOgolne() {
        if ( $this->session->userdata('uprawnienia_katalog') > 2 AND $this->session->userdata('logged_in') == TRUE ) {

            $this->form_validation->set_rules('nazwa', 'nazwa', 'required');
            $this->form_validation->set_rules('qr', 'qr kod', 'required');

            $id = $this->uri->segment(3);

            $this->load->model('AppModel');

            if ( $this->form_validation->run() == FALSE ) {
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Ups!</h4>Coś poszło nie tak, spróbuj jeszcze raz.</div>');
                redirect('App/czescPopraw/' . $id, $wiadomosc_przekierowania);
                refresh();
            } else {
                $aktualizacja_czesci = array(
                    "qr" => $this->input->post("qr", TRUE),
                    "nazwa" => $this->input->post("nazwa", TRUE),
                    "sku" => $this->input->post("sku", TRUE),
                    "stan_w_magazynie" => $this->input->post("stan_w_magazynie", TRUE),
                    "kategorie_id" => $this->input->post("kategorie_id", TRUE),
                    "projekty_id" => $this->input->post("projekty_id", TRUE),
                    "wymagana_ilosc_w_projekcie" => $this->input->post("wymagana_ilosc_w_projekcie", TRUE),
                    "katalog_statusy_id" => $this->input->post("katalog_statusy_id", TRUE),
                );
                //aktualizacja w bazie
                $this->AppModel->updateWhere("katalog", "id", $id, $aktualizacja_czesci);
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Część zapisana.</div>');
                redirect('App/czescPopraw/' . $id, $wiadomosc_przekierowania);
                refresh();
            }
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function czescDodajPlik() {
        if ( $this->session->userdata('uprawnienia_katalog') > 2 AND $this->session->userdata('logged_in') == TRUE ) {

            $id = $this->uri->segment(3);

            $this->load->model('AppModel');

            $opis_pliku = $this->input->post("opis_pliku", TRUE);

            $config['upload_path']          = '././assets/upload/';
            $config['allowed_types']        = 'pdf|doc|docx|csv|jpg|mp4|xls|xlsx';
            $config['max_size']             = 102400;//100mb
            $config['overwrite']            = FALSE;
            
            $this->load->library('upload', $config);
            
            if ( ! $this->upload->do_upload('nazwa_pliku') ) {
                $data['errors'] = array('error' => $this->upload->display_errors());
                
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Ups!</h4>Coś poszło nie tak, spróbuj jeszcze raz.<br>' . $data['errors'] . '</div>');
                redirect('App/czescPopraw/' . $id, $wiadomosc_przekierowania);
                refresh();
            } else {
                $plik = array('upload_data' => $this->upload->data());
                
                //print_r($data['upload_data']['file_name']);
                
                $nowy_plik = array(
                    'nazwa_pliku' => $plik['upload_data']['file_name'],
                    'opis_pliku' => $opis_pliku,
                    'katalog_id' => $id,
                );
                
                $this->load->model('AppModel');
                $this->AppModel->insert('katalog_pliki', $nowy_plik);
                
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Plik dodany poprawnie.</div>');
                redirect('App/czescPopraw/' . $id, $wiadomosc_przekierowania);
                refresh();
            }
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function czescUsunPlik() {
        if ( $this->session->userdata('uprawnienia_katalog') > 3 AND $this->session->userdata('logged_in') == TRUE ) {
            $id = $this->uri->segment(3);

            $this->load->model('AppModel');

            $szukany_plik = $this->AppModel->selectWhere("katalog_pliki", "id", $id);

            $this->AppModel->deleteWhere("katalog_pliki", "id", $id);

            unlink('././assets/upload/' . $szukany_plik[0]->nazwa_pliku);

            //przekierowanie
            $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Plik usunięty poprawnie.</div>');
            redirect('App/czescPopraw/' . $szukany_plik[0]->katalog_id, $wiadomosc_przekierowania);
            refresh();
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function czescUsun() {
        if ( $this->session->userdata('uprawnienia_katalog') > 3 AND $this->session->userdata('logged_in') == TRUE ) {
            $id = $this->uri->segment(3);

            $this->load->model('AppModel');

            $szukane_pliki = $this->AppModel->selectWhere("katalog_pliki", "katalog_id", $id);

            //usuwanie plików
            foreach ( $szukane_pliki as $szukany ) {
                unlink('././assets/upload/' . $szukany->nazwa_pliku);
                $this->AppModel->deleteWhere("katalog_pliki", "id", $szukany->id);
            }
            //usuwanie czesci
            $this->AppModel->deleteWhere("katalog", "id", $id);
            //przekierowanie
            $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Część usunięta z katalogu poprawnie.</div>');
            redirect('App/katalog/', $wiadomosc_przekierowania);
            refresh();
        } else {
            redirect('App/zalogujSie');
        }
    }
    /* koniec modul katalog */

    /* modul kategorie */
    public function kategorie() {
        if ( $this->session->userdata('uprawnienia_kategorie') > 0 AND $this->session->userdata('logged_in') == TRUE ) {
            $this->load->model('AppModel');
            
            $data['kategorie'] = $this->AppModel->select('kategorie');
            
            $this->header();
            $this->load->view('app/kategorie/kategorie', $data);
            $this->load->view('app/inc/footer');
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function kategorieDodaj() {
        if ( $this->session->userdata('uprawnienia_kategorie') > 1 AND $this->session->userdata('logged_in') == TRUE ) {

            $this->form_validation->set_rules('nazwa', 'nazwa', 'required');

            if ( $this->form_validation->run() == FALSE ) {
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Ups!</h4>Coś poszło nie tak spróbuj jeszcze raz.</div>');
                redirect('App/kategorie/', $wiadomosc_przekierowania);
                refresh();
            } else {
                $nazwa_kategorii = $this->input->post("nazwa", TRUE);

                $nowa_kategoria = array(
                    "nazwa" => $nazwa_kategorii,
                    "kategorie_id" => $this->uri->segment(3),
                );
                //ladowanie do bazy
                $this->load->model("AppModel");
                $this->AppModel->insert("kategorie", $nowa_kategoria);
                //dodanie logu
                $this->dodajLog( "kategorie", "Dodanie kategorii o nazwie: $nazwa_kategorii", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Kategoria dodana poprawnie.</div>');
                redirect('App/kategorie/', $wiadomosc_przekierowania);
                refresh();
            }
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function kategoriePopraw() {
        if ( $this->session->userdata('uprawnienia_kategorie') > 2 AND $this->session->userdata('logged_in') == TRUE ) {

            $id = $this->uri->segment(3);

            $this->form_validation->set_rules('nazwa', 'nazwa', 'required');

            if ( $this->form_validation->run() == FALSE ) {
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Ups!</h4>Coś poszło nie tak spróbuj jeszcze raz.</div>');
                redirect('App/kategorie/', $wiadomosc_przekierowania);
                refresh();
            } else {
                $aktualizacja_kategorii = array(
                    "nazwa" => $this->input->post("nazwa", TRUE),
                );
                //ladowanie do bazy
                $this->load->model("AppModel");
                $this->AppModel->updateWhere("kategorie", "id", $id, $aktualizacja_kategorii);
                //dodanie logu
                $this->dodajLog( "kategorie", "Poprawa nazwy kategorii o id: $id", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Kategoria dodana poprawnie.</div>');
                redirect('App/kategorie/', $wiadomosc_przekierowania);
                refresh();
            }
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function kategorieUsun() {
        if ( $this->session->userdata('uprawnienia_kategorie') > 3 AND $this->session->userdata('logged_in') == TRUE ) {

            $id = $this->uri->segment(3);

            $this->load->model("AppModel");
            $this->AppModel->deleteWhere("kategorie", "id", $id);
            //dodanie logu
            $this->dodajLog( "kategorie", "Usunięcie kategorii o id: $id", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
            //przekierowanie
            $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Kategoria usunięta poprawnie.</div>');
            redirect('App/kategorie/', $wiadomosc_przekierowania);
            refresh();

        } else {
            redirect('App/zalogujSie');
        }
    }
    /* koniec modul kategorie */

    /* modul projekt */
    public function projekty() {
        if ( $this->session->userdata('uprawnienia_projekty') > 0 AND $this->session->userdata('logged_in') == TRUE ) {
            $this->load->model('AppModel');
            
            $data['projekty'] = $this->AppModel->select('projekty');
            
            $this->header();
            $this->load->view('app/projekty/projekty', $data);
            $this->load->view('app/inc/footer');
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function projektDodaj() {
        if ( $this->session->userdata('uprawnienia_projekty') > 1 AND $this->session->userdata('logged_in') == TRUE ) {

            $this->form_validation->set_rules('nazwa', 'nazwa', 'required');

            if ( $this->form_validation->run() == FALSE ) {
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Ups!</h4>Coś poszło nie tak spróbuj jeszcze raz.</div>');
                redirect('App/projekty/', $wiadomosc_przekierowania);
                refresh();
            } else {
                $nazwa_projektu = $this->input->post("nazwa", TRUE);

                $nowa_projekt = array(
                    "nazwa" => $nazwa_projektu,
                );
                //ladowanie do bazy
                $this->load->model("AppModel");
                $this->AppModel->insert("projekty", $nowa_projekt);
                //dodanie logu
                $this->dodajLog( "projekty", "Dodanie projektu o nazwie: $nazwa_projektu", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Projekt dodany poprawnie.</div>');
                redirect('App/projekty/', $wiadomosc_przekierowania);
                refresh();
            }
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function projektPopraw() {
        if ( $this->session->userdata('uprawnienia_projekty') > 2 AND $this->session->userdata('logged_in') == TRUE ) {

            $id = $this->uri->segment(3);

            $this->form_validation->set_rules('nazwa', 'nazwa', 'required');

            if ( $this->form_validation->run() == FALSE ) {
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Ups!</h4>Coś poszło nie tak spróbuj jeszcze raz.</div>');
                redirect('App/projekty/', $wiadomosc_przekierowania);
                refresh();
            } else {
                $aktualizacja_projektu = array(
                    "nazwa" => $this->input->post("nazwa", TRUE),
                );
                //ladowanie do bazy
                $this->load->model("AppModel");
                $this->AppModel->updateWhere("projekty", "id", $id, $aktualizacja_projektu);
                //dodanie logu
                $this->dodajLog( "projekty", "Poprawa nazwy projektu o id: $id", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Projekt zapisany poprawnie.</div>');
                redirect('App/projekty/', $wiadomosc_przekierowania);
                refresh();
            }
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function projektUsun() {
        if ( $this->session->userdata('uprawnienia_projekty') > 3 AND $this->session->userdata('logged_in') == TRUE ) {

            $id = $this->uri->segment(3);

            $this->load->model("AppModel");
            $this->AppModel->deleteWhere("projekty", "id", $id);
            //dodanie logu
            $this->dodajLog( "projekty", "Usunięcie projektu o id: $id", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
            //przekierowanie
            $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Projekt usunięty poprawnie.</div>');
            redirect('App/projekty/', $wiadomosc_przekierowania);
            refresh();

        } else {
            redirect('App/zalogujSie');
        }
    }
    /* koniec modul projekty */

    /* modul logi */
    function dodajLog($modul = "", $tresc = "", $data_logu = "", $uzytkownicy_id = 0) {
        $this->load->model("AppModel");

        $nowy_log = array(
            "modul" => $modul,
            "tresc" => $tresc,
            "data_logu" => $data_logu,
            "uzytkownicy_id" => $uzytkownicy_id,
        );
        $this->AppModel->insert("logi", $nowy_log);
    }
    /* koniec modulu logi */

    /*modul uzytkownicy*/
    public function mojeKonto() {//pozwala zmienic tylko haslo
        if ( $this->session->userdata('logged_in') == TRUE ) {
            $uzytkownik_id = $this->session->userdata("uzytkownik_id");

            $this->form_validation->set_rules('stare_haslo', 'stare hasło', 'required');
            $this->form_validation->set_rules('nowe_haslo', 'nowe hasło', 'required');

            if ( $this->form_validation->run() == FALSE ) {
                $this->header();
                $this->load->view('app/mojeKonto');
                $this->load->view('app/inc/footer');
            } else {
                $this->load->model("AppModel");

                $stare_haslo = sha1( $this->input->post( "stare_haslo", TRUE ) );
                $nowe_haslo = sha1( $this->input->post( "nowe_haslo", TRUE ) );

                $szukamy_starego_hasla = $this->AppModel->selectWhere("uzytkownicy", "id", $uzytkownik_id);
                //sprawdzanie czy stare haslo jest ok
                if ( $szukamy_starego_hasla[0]->haslo == $stare_haslo ) {
                    $nowe_haslo_do_bazy = array(
                        "haslo" => $nowe_haslo
                    );
                    $this->AppModel->updateWhere("uzytkownicy", "id", $uzytkownik_id, $nowe_haslo_do_bazy);
                    //przekierowanie
                    $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Hasło zmienione.</div>');
                    redirect('App/mojeKonto/', $wiadomosc_przekierowania);
                    refresh();
                } else {
                    //przekierowanie
                    $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Ups!</h4>Coś poszło nie tak, spróbuj jeszcze raz.</div>');
                    redirect('App/mojeKonto/', $wiadomosc_przekierowania);
                    refresh();
                }
            }
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function uzytkownicy() {
        if ( $this->session->userdata('uprawnienia_uzytkownicy') > 0 AND $this->session->userdata('logged_in') == TRUE ) {
            $this->load->model('AppModel');
            
            $data['uzytkownicy'] = $this->AppModel->select('uzytkownicy');
            
            $this->header();
            $this->load->view('app/uzytkownicy/uzytkownicy', $data);
            $this->load->view('app/inc/footer');
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function uzytkownikDodaj() {
        if ( $this->session->userdata('uprawnienia_uzytkownicy') > 1 AND $this->session->userdata('logged_in') == TRUE ) {
            $this->form_validation->set_rules('login', 'login', 'required|is_unique[uzytkownicy.login]');
            $this->form_validation->set_rules('haslo', 'hasło', 'required');
            $this->form_validation->set_rules('imie', 'imię', 'required');
            $this->form_validation->set_rules('nazwisko', 'nazwisko', 'required');
            
            if ( $this->form_validation->run() == FALSE ) {
                
                $this->header();
                $this->load->view('app/uzytkownicy/uzytkownikDodaj');
                $this->load->view('app/inc/footer');
            } else {
                $this->load->helper("my_helper");
                $this->load->model('AppModel');
                
                //generowanie unikalnego kodu by znależć w bazie dodanego pracownika
                $unikalny_kod = random_string(16);
                
                while (TRUE) {
                    $szukamyCzyKodIstnieje = $this->AppModel->selectWhere("uzytkownicy", "unikalny_kod", $unikalny_kod);
                    
                    if ($szukamyCzyKodIstnieje == NULL) {
                        break;
                    } else {
                        $unikalny_kod = random_string(16);
                    }
                }
                //koniec generowanie unikalnego kodu by znależć w bazie dodanego pracownika
                
                $nowy_uzytkownik = array(
                    "unikalny_kod" => $unikalny_kod,
                    'login' => $this->input->post('login', TRUE),
                    'haslo' => sha1( $this->input->post('haslo', TRUE) ),
                    'imie' => $this->input->post('imie', TRUE),
                    'nazwisko' => $this->input->post('nazwisko', TRUE),
                    'numer_telefonu' => $this->input->post('numer_telefonu', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'stanowisko' => $this->input->post('stanowisko', TRUE),
                    'konto_aktywne' => $this->input->post('konto_aktywne', TRUE),
                );
                //dodanie nowego pracownika
                $this->AppModel->insert('uzytkownicy', $nowy_uzytkownik);
                //szukanie unikalnego kodu i przekierowanie do widoku popraw z tym pracownikiem
                $dodanyPrzedChwilaUzytkownik = $this->AppModel->selectWhere("uzytkownicy", "unikalny_kod", $unikalny_kod);
                //dodawanie logu
                $this->dodajLog( "uzytkownicy", "Dodanie nowego użytkownika", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Pracownik dodany poprawnie.</div>');
                redirect('App/uzytkownikPopraw/' . $dodanyPrzedChwilaUzytkownik[0]->id, $wiadomosc_przekierowania);
                refresh();
            }
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function uzytkownikPopraw() {
        if ( $this->session->userdata('uprawnienia_uzytkownicy') > 2 AND $this->session->userdata('logged_in') == TRUE ) {
            $id = $this->uri->segment(3);
            
            $this->load->model("AppModel");
            
            $data["uzytkownik"] = $this->AppModel->selectWhere("uzytkownicy", "id", $id);
            
            $this->header();
            $this->load->view('app/uzytkownicy/uzytkownikPopraw', $data);
            $this->load->view('app/inc/footer');
        } else {
            redirect('App/zalogujeSie');
        }
    }

    public function uzytkownikPoprawOgolne() {
        if ( $this->session->userdata('uprawnienia_uzytkownicy') > 2 AND $this->session->userdata('logged_in') == TRUE ) {
            $id = $this->uri->segment(3);
            
            $this->form_validation->set_rules('imie', 'imię', 'required');
            $this->form_validation->set_rules('nazwisko', 'nazwisko', 'required');
            
            if ( $this->form_validation->run() == FALSE ) {
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Ups!</h4>Coś poszło nie tak, spróbuj jeszcze raz.</div>');
                redirect('App/uzytkownikPopraw/' . $id, $wiadomosc_przekierowania);
                refresh();
            } else {
                $uzytkownik = array(
                    'imie' => $this->input->post('imie', TRUE),
                    'nazwisko' => $this->input->post('nazwisko', TRUE),
                    'numer_telefonu' => $this->input->post('numer_telefonu', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'stanowisko' => $this->input->post('stanowisko', TRUE),
                    'konto_aktywne' => $this->input->post('konto_aktywne', TRUE),
                );
                //dodanie logu
                $this->dodajLog( "uzytkownicy", "Poprawnienie ogólnych danych użytkownika o id: $id", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
                //aktualizacja bazy
                $this->load->model("AppModel");
                $this->AppModel->updateWhere("uzytkownicy", "id", $id, $uzytkownik);
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Uzytkownik zapisany poprawnie.</div>');
                redirect('App/uzytkownikPopraw/' . $id, $wiadomosc_przekierowania);
                refresh();
            }
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function uzytkownikPoprawUprawnienia() {
        if ( $this->session->userdata('uprawnienia_uzytkownicy') > 2 AND $this->session->userdata('logged_in') == TRUE ) {
            $id = $this->uri->segment(3);
            
            $uzytkownikUprawnienia = array(
                "uprawnienia_skaner" => $this->input->post("uprawnienia_skaner", TRUE),
                "uprawnienia_katalog" => $this->input->post("uprawnienia_katalog", TRUE),
                "uprawnienia_kategorie" => $this->input->post("uprawnienia_kategorie", TRUE),
                "uprawnienia_projekty" => $this->input->post("uprawnienia_projekty", TRUE),
                "uprawnienia_uzytkownicy" => $this->input->post("uprawnienia_uzytkownicy", TRUE),
                "uprawnienia_logi" => $this->input->post("uprawnienia_logi", TRUE)
            );
            //dodanie logu
            $this->dodajLog( "uzytkownicy", "Poprawnienie uprawnień użytkownika o id: $id", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
            //aktualizacja bazy
            $this->load->model("AppModel");
            $this->AppModel->updateWhere("uzytkownicy", "id", $id, $uzytkownikUprawnienia);
            //przekierowanie
            $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Uprawnienia użytkownika zapisane poprawnie.</div>');
            redirect('App/uzytkownikPopraw/' . $id, $wiadomosc_przekierowania);
            refresh();
        } else {
            redirect('App/zalogujSie');
        }
    }

    public function uzytkownikUsun() {
        if ( $this->session->userdata('uprawnienia_uzytkownicy') > 3 AND $this->session->userdata('logged_in') == TRUE ) {
            $id = $this->uri->segment(3);
            
            //dodanie logu
            $this->dodajLog( "uzytkownicy", "Usunięcie użytkownika o id: $id", date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
            //aktualizacja bazy
            $this->load->model("AppModel");
            $this->AppModel->deleteWhere("uzytkownicy", "id", $id);
            //przekierowanie
            $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukces!</h4>Uzytkownik usunięty poprawnie.</div>');
            redirect('App/uzytkownicy', $wiadomosc_przekierowania);
            refresh();
        } else {
            redirect('App/zalogujSie');
        }
    }
    /*koniec modulu uzytkownicy*/

    public function zalogujSie() {
        if ( $this->form_validation->run() == TRUE ) {
            
            //przekierowanie
            $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Witaj ponownie !</h4>Zalogowałeś się poprawnie.</div>');
            redirect('App/zalogujSie' , $wiadomosc_przekierowania);
            refresh();
        } else {

            $this->load->view("app/zalogujSie");

        }
    }
    
    public function autoryzacja() {
        $this->form_validation->set_rules("login", "login", "required");
        $this->form_validation->set_rules("haslo", "hasło", "required");
        
        if ( $this->form_validation->run() == FALSE ) {
            $this->load->view("app/zalogujSie");
        } else {
            $this->load->model("AppModel");
            
            $login = $this->input->post("login", TRUE);
            $haslo = sha1( $this->input->post("haslo", TRUE) );
            
            $uzytkownik = $this->AppModel->selectWhereWhere("uzytkownicy", "login", $login, "konto_aktywne", 1);
            
            //sprawdzamy czy jest rekord o takim loginie
            if ( $uzytkownik != NULL && count($uzytkownik) == 1 ) {
                //sprawdzamy czy login i hasło jest poprawne
                if ( $uzytkownik[0]->login == $login && $haslo == $uzytkownik[0]->haslo ) {
                    
                    $dane_zalogowanego_uzytkownika = array(
                        'uzytkownik_id'  => $uzytkownik[0]->id,
                        'logged_in' => TRUE,
                        "imie" => $uzytkownik[0]->imie,
                        "nazwisko" => $uzytkownik[0]->nazwisko,
                        "uprawnienia_skaner" => $uzytkownik[0]->uprawnienia_skaner,
                        "uprawnienia_katalog" => $uzytkownik[0]->uprawnienia_katalog,
                        "uprawnienia_kategorie" => $uzytkownik[0]->uprawnienia_kategorie,
                        "uprawnienia_projekty" => $uzytkownik[0]->uprawnienia_projekty,
                        "uprawnienia_uzytkownicy" => $uzytkownik[0]->uprawnienia_uzytkownicy,
                        "uprawnienia_logi" => $uzytkownik[0]->uprawnienia_logi,
                    );
                    //dodanie danych do sesji
                    $this->session->set_userdata( $dane_zalogowanego_uzytkownika );
                    //dodanie logu
                    $this->dodajLog( "logowanie", "Zalogowanie użytkownika o id: " . $uzytkownik[0]->id, date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
                    //przekierowanie
                    $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Witaj ponownie !</h4>Zalogowałeś się poprawnie.</div>');
                    redirect('App/index' , $wiadomosc_przekierowania);
                    refresh();
                    
                } else {
                    //przekierowanie
                    $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Coś poszło nie tak!</h4>Login lub hasło jest niepoprawne.</div>');
                    redirect("App/zalogujSie", $wiadomosc_przekierowania);
                    refresh();
                }
            } else {
                //przekierowanie
                $wiadomosc_przekierowania = $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Coś poszło nie tak!</h4>Login lub hasło jest niepoprawne.</div>');
                redirect("App/zalogujSie", $wiadomosc_przekierowania);
                refresh();
            }
        }
    }
    
    public function wylogujSie() {
        //dodanie logu
        $this->dodajLog( "logowanie", "Wylogowanie użytkownika o id: " . $this->session->userdata("uzytkownik_id"), date("Y-m-d H:i:s"), $this->session->userdata("uzytkownik_id") );
        //niszczenie sesji
        $this->session->sess_destroy();
        
        //przekierowanie
        redirect('App/zalogujSie');
    }
}