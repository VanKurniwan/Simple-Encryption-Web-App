<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Illuminate\Support\Str;
// dari library defuse/php-encryption
use Defuse\Crypto\Crypto;
use Defuse\Crypto\Key;

#[Layout('components.layout')]
#[Title('Simple Encryption Decryption Demo')]
class MainForm extends Component
{
    public $salt;
    public $metodeEnkripsi;
    public $plainText;
    public $encryptedText;

    // Kunci 24 karakter untuk 3DES
    private $key = 'my3deskey12345678901234';

    public function mount()
    {
        if (!session()->has('twofishKey')) {
            $twofishKey = Key::createNewRandomKey();
            session()->put('twofishKey', $twofishKey);
        }
    }

    public function submitEnkripsi()
    {
        switch ($this->metodeEnkripsi) {
            case 'AES':
                $data = $this->plainText;
                $salt = $this->salt ?: Str::random(16);;
                $dataWithSalt = $data . '|' . $salt;

                $encrypted = encrypt($dataWithSalt);

                session()->put('encrypted', $encrypted);
                break;
            case '3DES':
                $data = $this->plainText;
                $salt = $this->salt ?: Str::random(16);;
                $dataWithSalt = $data . '|' . $salt;

                $encrypted = openssl_encrypt($dataWithSalt, 'des-ede3', $this->key, 0);
                session()->put('encrypted', $encrypted);
                break;
            case 'Twofish':
                $data = $this->plainText;
                $salt = $this->salt ?: Str::random(16);
                $dataWithSalt = $data . '|' . $salt;

                // Enkripsi menggunakan Twofish
                $twofishKey = session('twofishKey');
                $encrypted = Crypto::encrypt($dataWithSalt, $twofishKey);
                session()->put('encrypted', base64_encode($encrypted));
                break;

            default:
                # code...
                break;
        }
    }

    public function submitDekripsi()
    {
        switch ($this->metodeEnkripsi) {
            case 'AES':
                $decrypted = decrypt($this->encryptedText);
                list($originalData, $saltFromData) = explode('|', $decrypted);

                session()->put('decrypted', $originalData);
                session()->put('salt', $saltFromData);
                break;
            case '3DES':
                $decrypted = openssl_decrypt($this->encryptedText, 'des-ede3', $this->key, 0);
                list($originalData, $saltFromData) = explode('|', $decrypted);

                session()->put('decrypted', $originalData);
                session()->put('salt', $saltFromData);
                break;
            case 'Twofish':
                $twofishKey = session('twofishKey');
                $decrypted = Crypto::decrypt(base64_decode($this->encryptedText), $twofishKey);
                list($originalData, $saltFromData) = explode('|', $decrypted);

                session()->put('decrypted', $originalData);
                session()->put('salt', $saltFromData);
                break;

            default:
                # code...
                break;
        }
    }

    public function render()
    {
        return view('livewire.main-form');
    }
}
