const lngs = {
    en: { nativeName: 'English' },
    lao: { nativeName: 'ພາສາລາວ' }
};

const en={
    nav: {
        span1: 'Hotel',
        span2: 'Management System',
    },
    sidebar:{
        name:"Sisavad Hotel",
        menu1:'Schedule',
        menu2:'Booking',
        menu3:'Rooms',
        menu4:'Reserve',
        menu5:{
            title:"Report",
            side_menu1:"Overview",
            side_menu2:"Revenue",
        },
        menu6:'Setting',
    },
    schedule:{
        title: "Schedule For",
        status:{
            finish: "Finished",
            stay: "Staying",
            reserve: "Reserved",
            maintanence: "Maintanence",
        },
        movement:{
            checkIn: "Checked In",
            checkout: "Checked Out",
            moved: "Moved",
            unpaid: "Not Paid",
        },
    },
    booking:{
        title: "Booking Information",
        placeholder:"Search...",
        table:{
            room: "Room",
            type: "Room Type",
            duration: "Duration",
            total: "Total", 
            status: "Status",
            action: "Action",
            payment: "Payment", 
            night: "Nights", 
        },
        info:{
            title:"Booking Info",
            checkin:"Checked In",
            checkout:"Checked Out",
            status:"Booking Status",
            duration:"Duration",
            total:"Total",
            status:"Booking Status",
            memo:"Memo",
            payment:{
                status:{
                    title:"Payment Status",
                    default:" -- Choose Payment Status --",
                },
                option:{
                    title:"Payment Option",
                    default:" -- Choose Payment Option --",
                    cash:"Cash"
                },
            },
        },
        status:{
            finish:"Finished",
            reserve:"Reserved",
            stay:"Staying",
            cancel:"Cancelled"
        },
        btnList:{
            cancel:"Cancel Booking",
            move:{
                value:"Move Room",
                title:"Moving Room Info",
                duration:"Remaining Duration",
                price:"New Room Price",
                charge:"Additional Charge",
            },
            extend:{
                value:"Extend Duration",
                title:"Extend Details",
                old_checkout:"Old Check Out Date",
                new_checkout:"New Check Out Date",
                duration:"Extend Duration",
                total:"Extend Total"
            },
            checkin:"Check In",
            checkout:"Check Out",
        }
    },
    rooms:{
        title: "Rooms Info",
        btn_add:"Add New Room",
        btn_view:"View",
        btn_booking:"Booking",
        error:"Please Fill In All The Fields",
        status:{
            free: "(Free)",
            occupy: "(Occupied)",
            reserve: "(Reserved)",
        },
        info:{
            title: "Room Info",
            name: "Room Name",
            type: "Room Type",
            price: "Room Price",
            status: "Room Status",
            select: "-- Choose Room Type--"
        },
        offsidebar:{
            title:"Booking List",
        },
    },
    customer:{
        title:"Customer Info",
        fullname:"Full Name",
        name:"Name",
        surname:"Family Name",
        bd:"Birthday",
        phone:"Phone no.",
        email:"Email",
        passport:"ID/Passport",
        btn_add:"Add New Customer"
    },
    reservation:{
        title:"Reservation Details",
        progress:{
            step1:"Customer Info",
            step2:"Booking Date",
            step3:"Reserve",
            btn_next:"Next",
            btn_back:"Back",
        },
        step1:{
            selector:"Select Customers"
        },
        step2:{
            date1:"Check In Date",
            date2:"Check Out Date",
            ranger:"Date Picker",
            type:"Room Type",
            room:"Room No.",
            duration:"Duration",
            price:"Price",
            total:"Total Amount",
        },
        step3:{
            title:"Hotel Receipt",
            subtitle:"Booking ID",
            employee:"Employee:",
            select:"Select the Employee",
            ref_code:"OnePay Reference Codes"
        }
    },
    report:{
        overview:{
            span1:"Total Rooms",
            span2:"Room Types",
            span3:"Cusotmers",
            span4:"Bookings",
            span5:"Employees",
            span6:"Revenue (KIP)",
            graph:{
                donut:"Current Room Status",
                pie:"Room Type Percentage",
                line:"Weekly Income",
                radar:"Room Statistics",
                bar:"Room Popularity",
                choice1:"Rooms by Popularity",
                choice2:"Rooms by Profit",
                table:{
                    tb1:"Top 5 With Most Fee",
                    tb2:{
                        people:"People",
                        male:"Male",
                    },
                    view:"View More"
                }
            }
        },
        revenue:{
            title:"Revenue Info",
            duration:{
                weekly:"Week",
                month:"Month",
                half:"6 Months",
                year:"Year"
            },
            graph:{
                bar:"Top 5 Popular Rooms",
                pie:"Popular Rooms Types",
                table:"(Top 10 bookings)",
            },
            statistics:{
                title:"Statistics",
                stat1:"Earned In",
                stat2:"Booking In",
                stat3:"Popular Room",
                stat4:"Popular Type"
            }
        }
    },
    setting:{
        type:{
            title:"Room Type Setting",
            value:"Room Type",
            info:"Room Type Info",
            new:"Click here to create new",
            id:"Room Type ID",
            name:"Room Type Name",
            price:"Room Type Price",
        },
        staff:{
            title:"Employee Setting",
            modal:"Employee Info",
            value:"Employee",
            new:"Click here to create new",
            info:{
                name:"Name",
                phone:"Phone",
                email:"Email",
                position:"Position",
                salary:"Salary",
                id_card:"ID Card",
                gender:"Gender",
                male:"Male",
                female:"Female"
            }
        }
    },
    modal:{
        close:"Close",
        edit:"Edit",
        save:"Save",
        cancel:"Cancel",
        reset:"Reset",
        delete:"Delete",
        submit:"Submit",
        add:"Add",
    },
    payment:{
        paid:"Paid",
        deposit:"Deposit",
        unpaid:"Unpaid",
        full_pay:"Fully Pay"
    },
    selector:{
        all:"All"
    },
    error:{
        err1:"You can't delete the room as it is already booked",
        err2:"You can't delete the creating room",
        err3:"Plese Deposit or fully pay the fee",
        err4:"Please Fully Pay The Fee",
        err5:"please Choose Date",
        err6:"Please Choose The Moving Room",
        err7:"Please choose Payment Option and Status",
        err8:"Please Select Room Type",
        err9:"Please input reference code",
    },
    confirm:{
        1:"Do you really wish to log out?",
        2:"If You Are Checking Out Early, You Won't Get Refund Of Remaining Days",
        3:"If you cancel the room, you won't get the money back",
    }
}

const lao={
    nav: {
        span1: 'ລະບົບ',
        span2: 'ຈັດການໂຮງແຮມ'
    },
    sidebar:{
        name:"ໂຮງແຮມສີສະຫວາດ",
        menu1:'ຕາຕະລາງ',
        menu2:'ການຈອງ',
        menu3:'ຂໍ້ມູນຫ້ອງ',
        menu4:'ຈອງຫ້ອງ',
        menu5:{
            title:"ການລາຍງານ",
            side_menu1:"ພາບລວມ",
            side_menu2:"ລາຍຮັບ",
        },
        menu6:'ການຕັ້ງຄ່າ',
    },
    schedule:{
        title: "ຕາຕະລາງລາຍງານ",
        status:{
            finish: "ຈ່າຍແລ້ວ",
            stay: "ກຳລັງພັກ",
            reserve: "ຈອງແລ້ວ",
            maintanence: "ປິດປັບປູງ",
        },
        movement:{
            checkIn: "Checked In",
            checkout: "Checked Out",
            moved: "ຍ້າຍຫ້ອງ",
            unpaid: "ຍັງບໍ່ຊຳລະ",
        },
    },
    booking:{
        title: "ຂໍ້ມູນການຈອງຫ້ອງພັກ",
        placeholder:"ຄົ້ນຫາ...",
        table:{
            room: "ຫ້ອງ",
            type: "ປະເພດຫ້ອງ",
            duration: "ລວມວັນພັກ",
            total: "ລວມທັງໝົດ", 
            status: "ສະຖານະ",
            action: "ການສະແດງ",
            payment: "ການຊຳລະເງີນ", 
            night: "ວັນ", 
        },
        info:{
            title:"ຂໍ້ມູນການຈອງ",
            checkin:"Checked In",
            checkout:"Checked Out",
            status:"ສະຖານະການຈອງ",
            duration:"ລວມວັນຈອງ",
            total:"ລວມທັງໝົດ",
            status:"ສະຖານະການຈອງ",
            memo:"ໝາຍເຫດ",
            payment:{
                status:{
                    title:"ສະຖານະການຊຳລະເງີນ",
                    default:" -- ເລືອກສະຖານະການຈ່າຍເງິນ --",
                },
                option:{
                    title:"ຕົວເລືອກການຊຳລະເງີນ",
                    default:" -- ເລືອກທາງການຈ່າຍເງິນ --",
                    cash:"ເງິນສົດ"
                },
            },
        },
        status:{
            finish:"ສໍາເລັດແລ້ວ",
            reserve:"ຈອງແລ້ວ",
            stay:"ພັກຢູ່",
            cancel:"ຍົກເລີກແລ້ວ"
        },
        btnList:{
            pay:"ເງີນສົດ",
            cancel:"ຍົກເລີກການຈອງ",
            move:{
                value:"ຍ້າຍຫ້ອງ",
                title:"ຂໍ້ມູນຍ້າຍຫ້ອງພັກ",
                duration:"ໄລຍະເວລາທີ່ເຫຼືອ",
                price:"ລາຄາຫ້ອງພັກໄໝ່",
                charge:"ຄ່າໃຊ້ຈ່າຍເພີ່ມເຕີມ",
            },
            extend:{
                value:"ເພີ່ມໄລຍະການຈອງ",
                title:"ເພີ່ມໄລຍະ ລາຍລະອຽດ",
                old_checkout:"ວັນທີເຊັກເອົາເກົ່າ",
                new_checkout:"ວັນທີເຊັກເອົາໃໝ່",
                duration:"ເພີ່ມໄລຍະເວລາ",
                total:"ໄລຍະເວລາທັ້ງໝົດ"
            },
            checkin:"Check In",
            checkout:"Check Out",
        }
    },
    rooms:{
        title: "ຂໍ້ມູນຫ້ອງ",
        btn_add:"ເພີ່ມຫ້ອງໄໝ່",
        btn_view:"ສະແດງ",
        error:"ກະລຸນາຕື່ມຂໍ້ມູນໃສ່ໃນທຸກຊ່ອງ",
        btn_booking:"ການຈອງ",
        status:{
            free: "(ວ່າງ)",
            occupy: "(ພັກຢູ່)",
            reserve: "(ຈອງແລ້ວ)",
        },
        info:{
            title: "ຂໍ້ມູນຫ້ອງ",
            name: "ຊື່ຫ້ອງ",
            type: "ປະເພດຫ້ອງ",
            price: "ລາຄາຫ້ອງ",
            status: "ສະຖານະ",
            select: "-- ເລືອກປະເພດຫ້ອງ --"
        },
        offsidebar:{
            title:"ລາຍການຈອງ",
        },
    },
    customer:{
        title:"ຂໍ້ມູນລູກຄ້າ",
        fullname:"ຊື່",
        name:"ຊື່",
        surname:"ນາມສະກຸນ",
        bd:"ວັນເດືອນປີເກີດ",
        phone:"ເບີຕິດຕໍ່",
        email:"ອີເມວ",
        passport:"ID/Passport",
        btn_add:"ເພີ່ມລູກຄ້າໃໝ່"
    },
    reservation:{
        title:"ລາຍລະອຽດການຈອງ",
        progress:{
            step1:"ລູກຄ້າ",
            step2:"ວັນທີຈອງ",
            step3:"ຈອງ",
            btn_next:"ຖັດໄປ",
            btn_back:"ກັບຄືນ",
        },
        step1:{
            selector:"ເລືອກລູກຄ້າ"
        },
        step2:{
            date1:"ວັນທີ Check In",
            date2:"ວັນທີ Check Out",
            ranger:"ເລືອກວັນທີ",
            type:"ປະເພດຫ້ອງ",
            room:"ລຳດັບຫ້ອງ",
            duration:"ລວມ",
            price:"ລາຄາ",
            total:"ລວມທັງໝົດ",
        },
        step3:{
            title:"ໃບເກັບເງີນໂຮງແຮມ",
            subtitle:"Booking ID",
            employee:"ພະນັກງານ:",
            select:"ເລືອກພະນັກງານ",
            ref_code:"OnePay ​ເລກ​ອ້າງ​ອີງ"
        }
    },
    report:{
        overview:{
            span1:"ຫ້ອງທັງໝົດ",
            span2:"ປະເພດຫ້ອງ",
            span3:"ລູກຄ້າ",
            span4:"ການຈອງ",
            span5:"ພະນັກງານ",
            span6:"ລາຍຮັບ (KIP)",
            graph:{
                donut:"ສະຖານະຫ້ອງພັກປັດຈຸບັນ",
                pie:"ເປີເຊັນປະເພດຫ້ອງ",
                line:"ລາຍໄດ້ຕໍ່ປີ",
                radar:"ສະຖິຕິຫ້ອງພັກ",
                bar:"ຫ້ອງພັກທີ່ນິຍົມ",
                choice1:"ຫ້ອງທີ່ມີການຈອງຫຼາຍສຸດ",
                choice2:"ຫ້ອງທີ່ມີລາຍຮັບຫຼາຍສຸດ",
                table:{
                    tb1:"5 ອັນດັບຫ້ອງທີ່ພັກສູງສຸດ",
                    tb2:{
                        people:"ຄົນ",
                        male:"ຊາຍ",
                    },
                    view:"ເບິ່ງເພີ່ມເຕີມ"
                }
            }
        },
        revenue:{
            title:"ຂໍ້ມູນລາຍຮັບ",
            duration:{
                weekly:"ອາທິດ",
                month:"ເດືອນ",
                half:"6 ເດືອນ",
                year:"ປີ"
            },
            graph:{
                bar:"5 ອັນດັບຫ້ອງຍອດນິຍົມ",
                pie:"ປະເພດຫ້ອງຍອດນິຍົມ",
                table:"(10 ການຈອງລາຍໄດ້ສູງສຸດ)",
            },
            statistics:{
                title:"ສະຖິຕິ",
                stat1:"ໄດ້ຮັບໃນ",
                stat2:"ການຈອງໃນ",
                stat3:"ຫ້ອງຍອດນິຍົມ",
                stat4:"ປະເພດຫ້ອງນິຍົມ"
            },
        }
    },
    setting:{
        type:{
            title:"ການຕັ້ງຄ່າປະເພດຫ້ອງ",
            info:"ຂໍ້ມູນປະເພດຫ້ອງ",
            value:"ປະເພດຫ້ອງ",
            new:"ເພີ່ມ",
            id:"ID ປະເພດຫ້ອງ",
            name:"ລາຄາຫ້ອງ",
            price:"ລາຄາປະເພດຫ້ອງ",
        },
        staff:{
            title:"ການຕັ້ງຄ່າພະນັກງານ",
            modal:"ຂໍ້ມູນພະນັກງານ",
            value:"ພະນັກງານ",
            new:"ເພີ່ມ",
            info:{
                name:"ຊື່ພະນັກງານ",
                phone:"ເບີໂທ",
                email:"ອີເມວ",
                position:"ຕຳແໜ່ງ",
                salary:"ເງິນເດືອນ",
                id_card:"ID Card",
                gender:"ເພດ",
                male:"ເພດ​ຊາຍ",
                female:"ເພດຍິງ"
            }
        }
    },
    modal:{
        close:"ປິດ",
        edit:"ແກ້້ໄຂ",
        save:"ບັນທຶກ",
        cancel:"ຍົກເລີກ",
        reset:"ເລີ່ມໃໝ່",
        delete:"ລົບ",
        submit:"ບັນທຶກ",
        add:"ເພີ່ມ",
    },
    payment:{
        paid:"ຈ່າຍແລ້ວ",
        deposit:"ຈ່າຍເຄິ່ງລາຄາ",
        unpaid:"ຍັງບໍ່ໄດ້ຈ່າຍ",
        full_pay:"ຈ່າຍເຕັມ"
    },
    selector:{
        all:"ທັງໝົດ"
    },
    error:{
        err1:"ທ່ານບໍ່ສາມາດລຶບຫ້ອງໄດ້ເນື່ອງຈາກມັນຖືກຈອງແລ້ວ",
        err2:"ທ່ານບໍ່ສາມາດລຶບຫ້ອງສ້າງໄດ້",
        err3:"ກະລຸນາຝາກ ຫຼືຈ່າຍຄ່າທຳນຽມທັງໝົດ",
        err4:"ກະລຸນາຈ່າຍເຕັມທີ່",
        err5:"ກະລຸນາເລືອກວັນທີ",
        err6:"ກະລຸນາເລືອກຫ້ອງທີ່ຍ້າຍ",
        err7:"ກະລຸນາເລືອກທາງການຈ່າຍເງິນ ແລະ ສະຖານະ",
        err8:"ກະລຸນາເລືອກປະເພດຫ້ອງ",
        err9:"ກະລຸນາໃສ່ເລກອ້າງອີງ"
    },
    confirm:{
        1:"ເຈົ້າຢາກອອກຈາກລະບົບແທ້ບໍ?",
        2:"ຖ້າເຈົ້າກວດເຊັກກ່ອນໄວ, ເຈົ້າຈະບໍ່ໄດ້ຮັບເງິນຄືນຈາກມື້ທີ່ຍັງເຫຼືອ",
        3:"ຖ້າທ່ານຍົກເລີກຫ້ອງ, ທ່ານຈະບໍ່ໄດ້ຮັບເງິນຄືນ",
    }
}
  
const rerender = () => {
    $('body').localize();
}

$(function () {
    // use plugins and options as needed, for options, detail see
    // https://www.i18next.com
    i18next
      // detect user language
      // learn more: https://github.com/i18next/i18next-browser-languageDetector
    .use(i18nextBrowserLanguageDetector)
    // init i18next
    // for all options read: https://www.i18next.com/overview/configuration-options
    .init({
        debug: true,
        fallbackLng: 'en',
        resources: {
            en: {
                translation: en
            },
            lao: {
                translation: lao
            }
        }
    }, (err, t) => {
        if (err) return console.error(err);

        // for options see
        // https://github.com/i18next/jquery-i18next#initialize-the-plugin
        jqueryI18next.init(i18next, $, { useOptionsAttr: true });

        // fill language switcher when reloading and persists the chosen language
        Object.keys(lngs).map((lng) => {
            const li = document.createElement('li');

            li.classList.add('dropdown-menu-list');
            li.setAttribute("onclick", `changeLang('${lng}')`);

            li.innerHTML=`
                <img src="assets/img/${lng}-flag.png" height="20" alt="" />
                ${lngs[lng].nativeName}
            `;
            
            if (lng==="en") {
                li.classList.add("en-font");
            }else li.classList.add("lao-font");
            
            if (lng === i18next.resolvedLanguage) {
                $("#curr_lang").attr('src', `assets/img/${lng}-flag.png`);
            }

            $('#language-list').append(li);
        });

        if(i18next.resolvedLanguage==='en'){
            document.body.classList.remove('lao-font');
            document.body.classList.add('en-font');
        }else{
            document.body.classList.add('lao-font');
            document.body.classList.remove('en-font');
        }

        rerender();
    });
});


function changeLang(lng){
    $("#curr_lang").attr('src', `assets/img/${lng}-flag.png`);

    if (lng === i18next.resolvedLanguage) {
        return;
    }

    if(lng==='en'){
        document.body.classList.remove('lao-font');
        document.body.classList.add('en-font');
    }else{
        document.body.classList.add('lao-font');
        document.body.classList.remove('en-font');
    }

    i18next.changeLanguage(lng, () => {
        rerender();
    });
}
