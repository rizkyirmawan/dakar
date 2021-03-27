<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KaryawanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'nik' => 'required|unique:karyawan,nik',
                    'nama' => 'required',
                    'alamat' => 'required',
                    'nomor_telepon' => 'required|max:15',
                    'status_nikah' => 'required',
                    'pendidikan' => 'required',
                    'tanggal_masuk' => 'required',
                    'role' => 'required',
                    'atas_nama_rekening' => 'required',
                    'status_pekerja' => 'required',
                    'nomor_rekening' => 'required|max:25',
                    'bank_id' => 'required',
                    'bagian_id' => 'required',
                    'foto' => 'file|mimes:jpg,jpeg,png|max:2000'
                ];
                break;
            case 'PATCH':
                return [
                    'nik' => 'required|unique:karyawan,nik,' . $this->karyawan->id,
                    'alamat' => 'required',
                    'nomor_telepon' => 'required|max:15',
                    'status_nikah' => 'required',
                    'pendidikan' => 'required',
                    'tanggal_masuk' => 'required',
                    'role' => 'required',
                    'atas_nama_rekening' => 'required',
                    'status_pekerja' => 'required',
                    'nomor_rekening' => 'required|max:25',
                    'bank_id' => 'required',
                    'bagian_id' => 'required',
                    'foto' => 'file|mimes:jpg,jpeg,png|max:2000'
                ];
                break;
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'nik.required' => 'NIK tidak boleh kosong.',
            'nik.unique' => 'NIK sudah terdaftar.',
            'alamat.required' => 'Alamat tidak boleh kosong.',
            'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong.',
            'nomor_telepon.max' => 'Harap isi nomor telepon yang valid.',
            'status_nikah.required' => 'Status nikah tidak boleh kosong.',
            'pendidikan.required' => 'Pendidikan tidak boleh kosong.',
            'tanggal_masuk.required' => 'Tanggal masuk tidak boleh kosong.',
            'role.required' => 'Silahkan pilih jabatan.',
            'atas_nama_rekening.required' => 'Atas nama bank tidak boleh kosong.',
            'status_pekerja.required' => 'Status pekerja tidak boleh kosong.',
            'nomor_rekening.required' => 'Nomor rekening tidak boleh kosong.',
            'nomor_rekening.max' => 'Harap isi nomor rekening yang valid.',
            'bank_id.required' => 'Silahkan pilih bank.',
            'bagian_id.required' => 'Silahkan pilih bagian.',
            'foto.file' => 'Gagal membaca file foto.',
            'foto.mimes' => 'Format file harus diantara JPG, JPEG atau PNG.',
            'foto.size' => 'File foto tidak boleh lebih dari 2MB.'
        ];
    }
}
