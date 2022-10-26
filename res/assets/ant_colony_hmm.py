import sys
id_modul = sys.argv[1]
benar_modul = sys.argv[2]

# print (json.dumps(who))

modul = (id_modul.split(','))  
benar = (benar_modul.split(','))  
# print(modul,benar)


modul_awal = 1
modul_tujuan = len(modul)


JB = []
kinerja = []
rekom = []

for i in range(modul_tujuan):
    if(benar[i] !=''):
        JB.append(int(benar[i]))
        kinerja.append(int(benar[i]) / 3)
print(JB,kinerja)   



MODUL = []
for i in range(modul_tujuan):
    if(modul[i] !=''):
        MODUL.append(int(modul[i]))
# print(MODUL)


# estimasi = []
# for i in range(len(kinerja)):
#     if kinerja[i] < 0.3 :
#         E = 0.1
#         estimasi.append(E)
#     elif kinerja[i] >= 0.3 and kinerja[i] < 0.5:
#         E = 0.2
#         estimasi.append(E)
#     elif kinerja[i] >= 0.5 and kinerja[i] < 0.7:
#         E = 0.3
#         estimasi.append(E)
#     elif kinerja[i] >= 0.7 and kinerja[i] < 0.9:
#         E = 0.4
#         estimasi.append(E)
#     else:
#         E = 0.5
#         estimasi.append(E)

# print(estimasi)