import image from "./image";

export default {
    name: "work",
    title: "Work",
    type: "document",
    fields: [
        {
            name: "title",
            title: "Title",
            type: "string"
        },
        {
            name: "description",
            title: "Description",
            type: "string"
        },
        {
            name: "technique",
            title: "Technique",
            type: "string"
        },
        {
            name: "year",
            title: "Year",
            type: "number"
        },
        {
            name: "frontpage_image",
            title: "Frontpage Image",
            type: "image"
        },
        {
            name: "images",
            title: "Images",
            type: "array",
            of: [image]
        }
    ]
};
