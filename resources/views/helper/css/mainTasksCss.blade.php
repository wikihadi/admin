<style>
body, .content-wrapper, .main-heade{
    background: #CBCBCB!important;
}
.border-bottom{
    border-bottom: none!important;
}


input[type=range] {
    -webkit-appearance: none;
    margin: 20px 0;
    width: 100%;
}
input[type=range]:focus {
    outline: none;
}
input[type=range]::-webkit-slider-runnable-track {
    width: 100%;
    height: 8.4px;
    cursor: pointer;
    animate: 0.2s;
    background: #A880BC;
    border-radius: 1.3px;
}
input[type=range]::-webkit-slider-thumb {
    box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
    border: 1px solid #000000;
    height: 36px;
    width: 36px;
    border-radius: 50%;
    background: #ffffff;
    cursor: pointer;
    -webkit-appearance: none;
    margin-top: -14px;
}
input[type=range]:focus::-webkit-slider-runnable-track {
    background: #A880BC;
}
input[type=range]::-moz-range-track {
    width: 100%;
    height: 8.4px;
    cursor: pointer;
    animate: 0.2s;
    background: #A880BC;
    border-radius: 1.3px;
}
input[type=range]::-moz-range-thumb {
    height: 36px;
    width: 16px;
    border-radius: 3px;
    background: #ffffff;
    cursor: pointer;
}
input[type=range]::-ms-track {
    width: 100%;
    height: 8.4px;
    cursor: pointer;
    animate: 0.2s;
    background: transparent;
    border-color: transparent;
    border-width: 16px 0;
    color: transparent;
}
input[type=range]::-ms-fill-lower {
    background: #A880BC;
    border-radius: 2.6px;
}
input[type=range]::-ms-fill-upper {
    background: #A880BC;
    border-radius: 2.6px;
}
input[type=range]::-ms-thumb {
    height: 36px;
    width: 16px;
    border-radius: 3px;
    background: #ffffff;
    cursor: pointer;
}
input[type=range]:focus::-ms-fill-lower {
    background: #A880BC;
}
input[type=range]:focus::-ms-fill-upper {
    background: #A880BC;
}
.bullett{
    width: 30px;
    height: 30px;
    background: #A880BC;
    border-radius: 50%;
    position: absolute;
    top: 9px;
    z-index: 99;


}
/*td:first-child{*/
/*border-radius: 0 30px 30px 0;*/

/*}*/
/*td:last-child{*/
/*border-radius: 30px 0 0 30px;*/
/*}*/
/*td{*/
/*border: 1px solid black;*/
/*border-right: 0;*/
/*border-left: 0;*/
/*}*/


/*table{*/
/*border-collapse:separate;*/
/*border-spacing:0 15px;*/
/*}*/
.card-header{
    cursor: pointer;
}
.card-border{
    border-radius: 30px;
}

.comment-wrapper .panel-body {
    max-height: 650px;
    overflow: auto;
}

.comment-wrapper .media-list .media img {
    width: 64px;
    height: 64px;
    border: 2px solid #e5e7e8;
}

.comment-wrapper .media-list .media {
    border-bottom: 1px dashed #efefef;
    margin-bottom: 25px;
}
    .bg-pink{
        background-color: #FFF4F4!important;
        color: black!important;

    }
.bg-pink a{
    color: black!important;

}
.userJobsImage{
    object-fit: cover;
    width: 100px;
    height: 100px;
    filter: grayscale(1) ;

    -webkit-filter: grayscale(1) ;

    -moz-filter: grayscale(1) ;
}
.userJobsImage:hover{
    filter: none;
    transition: 0.5s ease-in-out;
}
.userJobsImageActive{
    object-fit: cover;
    width: 100px;
    height: 100px;
}

</style>