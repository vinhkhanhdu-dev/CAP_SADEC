import QRCode from 'qrcode';
import {PDFDocument, rgb} from 'pdf-lib';
import fontkit from '@pdf-lib/fontkit'; // Import fontkit
import robotoFont from '/assets/fonts/Roboto-Regular.ttf'; // Đường dẫn đến phông chữ
import robotoItalicFont from '/assets/fonts/Roboto-Italic.ttf'; // Đường dẫn đến phông chữ
import backgroundImage from '/assets/chungchimau/chungchiv2.jpg';
import backgroundImage2 from '/assets/chungchimau/chungchimau_back.jpg';
import imgStampSign from '/assets/chungchimau/sign.png';
import moment from 'moment/moment';

export default{
    name:"genPDF",
    methods:{
        removeDiacritics(str) {
            return str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        },
        getFileExtension(path) {
            const parts = path.split('.');
            return parts.length > 1 ? parts.pop() : '';
        },
        async signPfd(item, sign) {
            // 1. Tạo tài liệu PDF mới
            const pdfDoc = await PDFDocument.create();
            // Nhúng ảnh nền
            const imageBytes = await fetch(backgroundImage).then((res) =>
                res.arrayBuffer()
            );
            const jpgImage = await pdfDoc.embedJpg(imageBytes);
            const imageBytes2 = await fetch(backgroundImage2).then((res) =>
                res.arrayBuffer()
            );
            const jpgImage2 = await pdfDoc.embedJpg(imageBytes2);

            // 2. Đăng ký fontkit và nhúng phông Roboto
            pdfDoc.registerFontkit(fontkit);
            const fontBytes = await fetch(robotoFont).then((res) => res.arrayBuffer());
            const roboto = await pdfDoc.embedFont(fontBytes);
            const fontItalicBytes = await fetch(robotoItalicFont).then((res) => res.arrayBuffer());
            const robotoItalic = await pdfDoc.embedFont(fontItalicBytes);

            // 3. Thêm một trang mới vào PDF và vẽ văn bản
            const page = pdfDoc.addPage([600, 400]);
            page.drawImage(jpgImage, {
                x: 0,
                y: 0,
                width: page.getWidth(),
                height: page.getHeight(),
            });
            const {protocol, hostname, port, pathname, search, hash} = window.location;
            this.qrValue = 'http://' + hostname + ':' + port + '/check-file-in-pdf/' + item.id

            const qrImg = await QRCode.toDataURL(this.qrValue)
            const pngImageBytes = await fetch(qrImg).then(res => res.arrayBuffer());
            const qrCodeImg = await pdfDoc.embedPng(pngImageBytes);
            page.drawImage(qrCodeImg, {
                x: 220,
                y: 20,
                width: 60,
                height: 60,
            });
            //set anh 3*4
            const path3x4 = item.image
            if (path3x4 && path3x4 != 'null') {
                const imageBytes3x4 = await fetch(path3x4).then((res) =>
                    res.arrayBuffer()
                );


                if (path3x4 && ['PNG', 'png'].includes(this.getFileExtension(path3x4))) {
                    const jpgImage3x4 = await pdfDoc.embedPng(imageBytes3x4);
                    page.drawImage(jpgImage3x4, {
                        x: 48,
                        y: 65,
                        width: 39,
                        height: 52,
                    });
                } else {
                    const jpgImage3x4 = await pdfDoc.embedJpg(imageBytes3x4);
                    page.drawImage(jpgImage3x4, {
                        x: 48,
                        y: 65,
                        width: 39,
                        height: 52,
                    });
                }
            }


            // Set text
            page.drawText('RECTOR', {
                x: 126,
                y: 340,
                size: 12,
                font: roboto,
                color: rgb(1, 0, 0),
            });
            page.drawText('HIỆU TRƯỞNG', {
                x: 416,
                y: 340,
                size: 12,
                font: roboto,
                color: rgb(1, 0, 0),
            });

            page.drawText('TAN HIEP VOCATIONAL SCHOOL, KIEN GIANG PROVINCE', {
                x: 20,
                y: 320,
                size: 10,
                font: roboto,
                color: rgb(1, 0, 0),
            });
            page.drawText('TRƯỜNG TRUNG CẤP NGHỀ TÂN HIỆP TỈNH KIÊN GIANG', {
                x: 328,
                y: 320,
                size: 10,
                font: roboto,
                color: rgb(1, 0, 0),
            });
            // Ho ten
            page.drawText(this.removeDiacritics(item.hoTen), {
                x: 44,
                y: 253,
                size: 10,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            page.drawText(item.hoTen, {
                x: 342,
                y: 253,
                size: 10,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            // Gioi tinh
            page.drawText(item.gioiTinh, {
                x: 234,
                y: 253,
                size: 10,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            page.drawText(item.gioiTinh, {
                x: 552,
                y: 253,
                size: 10,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            // Nam sinh
            page.drawText(moment(item.namSinh, 'dd/mm/yyyy').format('MMMM DD, YYYY'), {
                x: 75,
                y: 231,
                size: 10,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            page.drawText(moment(item.namSinh, 'dd/mm/yyyy').format('DD/MM/YYYY'), {
                x: 363,
                y: 231,
                size: 10,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            //Khoa hoc
            page.drawText(item.khoa_hoc.tenKhoaHocEN, {
                x: 16,
                y: 190,
                size: 10,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            page.drawText(item.khoa_hoc.tenKhoaHoc, {
                x: 323,
                y: 190,
                size: 10,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            // Noi dao tao
            page.drawText('TAN HIEP VOCATIONAL SCHOOL, KIEN GIANG PROVINCE', {
                x: 32,
                y: 145,
                size: 9,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            page.drawText('TRƯỜNG TRUNG CẤP NGHỀ TÂN HIỆP TỈNH KIÊN GIANG', {
                x: 342,
                y: 145,
                size: 9,
                font: roboto,
                color: rgb(0, 0, 0),
            });
            // Ngay cap
            if (item.dot_cap && item.dot_cap.thoiGianCap) {
                page.drawText('Kien Giang  ' + moment(item.dot_cap.thoiGianCap, 'DD/MM/YYYY').format('MMMM DD, YYYY'), {
                    x: 141,
                    y: 125,
                    size: 9,
                    font: robotoItalic,
                    color: rgb(0, 0, 0),
                });
                page.drawText('Kiên Giang             ' + moment(item.dot_cap.thoiGianCap, 'DD/MM/YYYY').format('DD              MM             YYYY'), {
                    x: 405,
                    y: 125,
                    size: 9,
                    font: robotoItalic,
                    color: rgb(0, 0, 0),
                });
            }
            // Thoi gian hoc
            if(item.khoa_hoc){
                let khoaHoc =  item.khoa_hoc
                page.drawText(khoaHoc.thoiGianDaoTao, {
                    x: 86,
                    y: 166,
                    size: 9,
                    font: robotoItalic,
                    color: rgb(0, 0, 0),
                });
              
                page.drawText(khoaHoc.thoiGianDaoTao, {
                    x: 375,
                    y: 166,
                    size: 9,
                    font: robotoItalic,
                    color: rgb(0, 0, 0),
                });

                page.drawText(moment(khoaHoc.tuNgay, 'DD/MM/YYYY').format('DD    MM   YYYY'), {
                    x: 148,
                    y: 166,
                    size: 9,
                    font: robotoItalic,
                    color: rgb(0, 0, 0),
                });
              
                page.drawText(moment(khoaHoc.tuNgay, 'DD/MM/YYYY').format('DD   MM   YYYY'), {
                    x: 438,
                    y: 166,
                    size: 9,
                    font: robotoItalic,
                    color: rgb(0, 0, 0),
                });

                page.drawText(moment(khoaHoc.tuNgay, 'DD/MM/YYYY').format('DD    MM   YYYY'), {
                    x: 220,
                    y: 166,
                    size: 9,
                    font: robotoItalic,
                    color: rgb(0, 0, 0),
                });
              
                page.drawText(moment(khoaHoc.tuNgay, 'DD/MM/YYYY').format('DD   MM   YYYY'), {
                    x: 530,
                    y: 166,
                    size: 9,
                    font: robotoItalic,
                    color: rgb(0, 0, 0),
                });

            }

            page.drawText(item.maChungChi, {
                x: 65,
                y: 20,
                size: 12,
                font: robotoItalic,
                color: rgb(1, 0, 0),
            });
            page.drawText(item.maChungChi, {
                x: 368,
                y: 40,
                size: 12,
                font: robotoItalic,
                color: rgb(1, 0, 0),
            });

            // 4. Lưu Public Key vào metadata

            // pdfDoc.setTitle('Tài liệu chứa Public Key');
            if (sign) {
                //set imgsign
                const imgSign = item.ho_so_duyet.hinhanhchuky
                if (imgSign != 'null' && sign) {
                    const imageBytesimgSign = await fetch(imgSign).then((res) =>
                        res.arrayBuffer()
                    );
                
                    if (imgSign && ['PNG', 'png'].includes(this.getFileExtension(imgSign))) {
                        const jpgImageimgSign = await pdfDoc.embedPng(imageBytesimgSign);
                        page.drawImage(jpgImageimgSign, {
                            x: 480,
                            y: 55,
                            width: 49,
                            height: 52,
                        });
                    } else {
                        const jpgImageimgSign = await pdfDoc.embedJpg(imageBytesimgSign);
                        page.drawImage(jpgImageimgSign, {
                            x: 480,
                            y: 55,
                            width: 49,
                            height: 52,
                        });
                    }

                    page.drawText('Hiệu Trưởng', {
                        x: 480,
                        y: 108,
                        size: 9,
                        font: roboto,
                        color: rgb(0, 0, 0),
                    });

                    const imgStamp = await fetch(imgStampSign).then((res) =>
                        res.arrayBuffer()
                    );
                    const pngImageStamp = await pdfDoc.embedPng(imgStamp);
                    page.drawImage(pngImageStamp, {
                        x: 475,
                        y: 55,
                        width: 60,
                        height: 55,
                    });
                 
                }
                pdfDoc.setAuthor(item.ho_so_duyet.publickey); // Lưu vào trường 'Author'
                pdfDoc.setSubject(item.ho_so_duyet.hash)
                
                page.drawText(item.ho_so_duyet.soVaoSo, {
                    x: 428,
                    y: 20,
                    size: 12,
                    font: robotoItalic,
                    color: rgb(1, 0, 0),
                });


            }
            // Thêm một trang mới vào PDF và vẽ văn bản
            const page2 = pdfDoc.addPage([600, 400]);
            page2.drawImage(jpgImage2, {
                x: 0,
                y: 0,
                width: page2.getWidth(),
                height: page2.getHeight(),
            });

            // 5. Xuất PDF và tạo Blob để tải về
            const pdfBytes = await pdfDoc.save();
            const blob = new Blob([pdfBytes], {type: 'application/pdf'});

            // 6. Tạo liên kết tải PDF
            const url = URL.createObjectURL(blob);
            this.pdfSrc = url
            this.viewPdf = true
        },
    }
}