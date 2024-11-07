import { registerBlockType } from "@wordpress/blocks";
import {
  MediaUpload,
  InspectorControls,
  RichText,
} from "@wordpress/block-editor";
import { Button, PanelBody } from "@wordpress/components";
import { __ } from "@wordpress/i18n";

registerBlockType("mytheme/image-title", {
  title: __("Image with Title", "mytheme"),
  icon: "format-image",
  category: "media",
  attributes: {
    imageUrl: {
      type: "string",
      default: "",
    },
    title: {
      type: "string",
      default: __("Your Title Here", "mytheme"),
    },
  },
  edit: ({ attributes, setAttributes }) => {
    const { imageUrl, title } = attributes;

    return (
      <div className="image-title-block">
        <InspectorControls>
          <PanelBody title={__("Settings", "mytheme")}>
            <MediaUpload
              onSelect={(media) => setAttributes({ imageUrl: media.url })}
              allowedTypes={["image"]}
              value={imageUrl}
              render={({ open }) => (
                <Button
                  onClick={open}
                  isPrimary={!imageUrl}
                  isSecondary={!!imageUrl}
                >
                  {imageUrl
                    ? __("Change Image", "mytheme")
                    : __("Select Image", "mytheme")}
                </Button>
              )}
            />
          </PanelBody>
        </InspectorControls>

        <div
          className="image-container"
          style={{ backgroundImage: `url(${imageUrl})` }}
        >
          <div className="title-overlay">
            <RichText
              tagName="h2"
              value={title}
              onChange={(value) => setAttributes({ title: value })}
              placeholder={__("Enter title...", "mytheme")}
            />
          </div>
        </div>
      </div>
    );
  },
  save: () => null, // Save handled via PHP render callback
});
