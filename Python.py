class Mahasiswa:
    def __init__(self, nama, npm, jurusan, ipk):
        self.nama = nama
        self.npm = npm
        self.jurusan = jurusan
        self.ipk = ipk

def main():
    jumlah_mahasiswa = int(input("Masukkan jumlah mahasiswa yang ingin diinput: "))

    # Membuat list untuk menyimpan objek Mahasiswa
    mahasiswa_list = []

    # Menginput data mahasiswa
    for i in range(jumlah_mahasiswa):
        print(f"Masukkan data untuk mahasiswa ke-{i + 1}:")
        nama = input("Nama: ")
        npm = input("NPM: ")
        jurusan = input("Jurusan: ")
        ipk = float(input("IPK: "))

        # Membuat objek Mahasiswa dan menyimpannya dalam list
        mahasiswa_list.append(Mahasiswa(nama, npm, jurusan, ipk))

    # Menampilkan data mahasiswa
    print("\nData Mahasiswa:")
    for i, mahasiswa in enumerate(mahasiswa_list, start=1):
        print(f"Mahasiswa ke-{i}:")
        print("Nama:", mahasiswa.nama)
        print("NPM:", mahasiswa.npm)
        print("Jurusan:", mahasiswa.jurusan)
        print("IPK:", mahasiswa.ipk)
        print()

if __name__ == "__main__":
    main()
