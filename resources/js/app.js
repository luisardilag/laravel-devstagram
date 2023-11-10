import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

const dropzone = new Dropzone("#dropzone", {
    dictDefaultMessage: "Sube tu imagen aquí",
    acceptedFiles: ".jpg,.png,.jpeg, .webp",
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar imagen",
    maxFiles: 1,
    uploadMultiple: false,
});

dropzone.on("sending", function (file, xhr, formData) {
    console.log(formData);
});

dropzone.on("success", function (file, res) {
    console.log(res);
});

dropzone.on("error", function (file, message) {
    console.log(message);
});

dropzone.on("removedFile", function () {});
