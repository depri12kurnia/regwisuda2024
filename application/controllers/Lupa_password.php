<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Lupa_password extends CI_Controller
{
    // Load model
    public function __construct()
    {
        parent::__construct();
        $this->load->model('lupa_model');
    }
    public function index()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Halaman Reset Password';
            $this->load->view('login/lupa_password', $data);
        } else {
            $email = $this->input->post('email');
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->lupa_model->getUserInfoByEmail($clean);

            if (!$userInfo) {
                $this->session->set_flashdata('warning', 'Email Anda Tidak Terdaftar, Silakan Coba Lagi.');
                redirect(base_url('login'), 'refresh');
            }

            //build token   

            $token = $this->lupa_model->insertToken($userInfo->id_user);
            $qstring = $this->base64url_encode($token);
            $url = base_url() . 'lupa_password/reset_password/token/' . $qstring;
            $link = '<a href="' . $url . '">' . $url . '</a>';

            $this->sending($email, $link);
            $this->session->set_flashdata('sukses', 'Silahkan Buka Email Untuk Membuat Password Baru');
            redirect(base_url('login'), 'refresh');
        }
    }

    public function reset_password()
    {
        $token = $this->base64url_decode($this->uri->segment(4));
        $cleanToken = $this->security->xss_clean($token);

        $user_info = $this->lupa_model->isTokenValid($cleanToken); //either false or array();          

        if (!$user_info) {
            $this->session->set_flashdata('sukses', 'Token tidak valid atau kadaluarsa');
            redirect(base_url('login'), 'refresh');
        }

        $data = array(
            'title' => 'Halaman Reset Password',
            'nama' => $user_info->nama,
            'email' => $user_info->email,
            'token' => $this->base64url_encode($token)
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login/update_password', $data);
        } else {

            $post = $this->input->post(NULL, TRUE);
            $cleanPost = $this->security->xss_clean($post);
            $hashed = sha1($cleanPost['password']);
            $cleanPost['password'] = $hashed;
            $cleanPost['id_user'] = $user_info->id_user;
            unset($cleanPost['passconf']);
            if (!$this->lupa_model->updatePassword($cleanPost)) {
                $this->session->set_flashdata('warning', 'Update password gagal.');
                redirect(base_url('lupa_password'), 'refresh');
            } else {
                $this->session->set_flashdata('sukses', 'Password anda sudah diperbaharui. Silakan login.');
                redirect(base_url('login'), 'refresh');
            }
        }
    }

    public function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    public function base64url_decode($data)
    {
        return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
    }

    public function sending($email, $link)
    {
        $developmentMode = true;
        $mailer = new PHPMailer($developmentMode);

        try {

            $mailer->isSMTP();

            if ($developmentMode) {
                $mailer->SMTPOptions = [
                    'ssl' => [
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    ]
                ];
            }

            $mailer->Host = 'smtp.gmail.com';
            $mailer->SMTPAuth = true;
            $mailer->Username = 'shortlinkjakarta3@gmail.com';
            $mailer->Password = 'xsnottnbrmrgboss';
            $mailer->SMTPSecure = 'ssl';
            $mailer->Port = 465;

            $mailer->setFrom('shortlinkjakarta3@gmail.com', 'PANITIA PENERIMAAN BEASISWA POLTEKKES JAKARTA III');
            $mailer->addAddress($email);

            $mailer->isHTML(true);
            $mailer->Subject = 'Lupa Password Beasiswa';
            $mailer->Body = '<h2>Hallo,</h2>
                            Anda menerima email ini karena ada permintaan untuk memperbaharui password anda.<br>
                            Silahkan klik di link berikut untuk reset password : <br>
                            <h3><b>' . $link . '</b></h3><br>
                            Terima Kasih.<br>
                        ';

            $mailer->send();
            $mailer->ClearAllRecipients();
            // $this->session->set_flashdata('sukses', 'Registrasi Anda Berhasil Silahkan Cek Email dan Verifikasi Email Anda');
        } catch (Exception $e) {
            // $this->session->set_flashdata('warning', 'Registrasi Anda Berhasil Tapi Gagal Mengirim Email Silahkan Cek Kembali' . $mailer->ErrorInfo);
            // echo "EMAIL SENDING FAILED. INFO: " . $mailer->ErrorInfo;
        }
    }
}
