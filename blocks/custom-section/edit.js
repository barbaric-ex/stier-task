import { useBlockProps } from "@wordpress/block-editor";
import {
  TextControl,
  TextareaControl,
  Button,
  MediaUpload,
  SelectControl,
} from "@wordpress/components";
import { __ } from "@wordpress/i18n";

const Edit = (props) => {
  const { attributes, setAttributes } = props;
  return (
    <div {...useBlockProps()}>
      <SelectControl
        label="Text Position"
        value={attributes.textPosition}
        options={[
          { label: "Left", value: "left" },
          { label: "Right", value: "right" },
        ]}
        onChange={(value) => setAttributes({ textPosition: value })}
      />
      <TextControl
        label="Title"
        value={attributes.title}
        onChange={(value) => setAttributes({ title: value })}
      />
      <TextareaControl
        label="Description"
        value={attributes.description}
        onChange={(value) => setAttributes({ description: value })}
      />
      <TextControl
        label="Read More Text"
        value={attributes.readMoreText}
        onChange={(value) => setAttributes({ readMoreText: value })}
      />
      <MediaUpload
        label="Image"
        onSelect={(media) => setAttributes({ imageUrl: media.url })}
        allowedTypes={["image"]}
        render={({ open }) => <Button onClick={open}>Upload Image</Button>}
      />
      <TextControl
        label="Button Text"
        value={attributes.buttonText}
        onChange={(value) => setAttributes({ buttonText: value })}
      />
      <TextControl
        label="Button URL"
        value={attributes.buttonUrl}
        onChange={(value) => setAttributes({ buttonUrl: value })}
      />
    </div>
  );
};

export default Edit;
