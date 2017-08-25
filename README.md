Custom Upload Path
======================

Lets you customize the upload path of a specific content with the option `upload_dir`. All fields in this specific content type using Bolt.cm upload functionality are using this custom path afterwards.


For example the following content type uploads the images/files to `galleries/{%slug%}`:

```yaml
galleries:
    name: Galleries
    singular_name: Gallery
    fields:
        title:
            type: text
            group: "Gallery"
        slug:
            type: slug
            uses: [ title ]
        files:
            type: filelist
        images:
            type: imagelist
            extensions: [ jpg ]
    show_on_dashboard: true
    default_status: publish
    searchable: false
    upload_dir: galleries/{slug}/
```

In the example above the following variable are supported in the path: {slug}, {title}
