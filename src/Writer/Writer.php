<?php

namespace Dhii\SimpleTest\Writer;

/**
 * A default writer implementation.
 *
 * @since 0.1.0
 */
class Writer extends AbstractWriter
{
    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    public function _write($text)
    {
        echo $text;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    public function writeH5($text, $level = self::LVL_1)
    {
        $this->writeLine(str_pad(' ' . $text, static::LINE_WIDTH, static::DEC_CHAR_3, STR_PAD_LEFT), $level);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    public function writeH4($text, $level = self::LVL_1)
    {
        $this->writeLine('', $level);
        $this->writeLine($text, $level);
        $this->writeLine(str_pad('', static::LINE_WIDTH, static::DEC_CHAR_1, STR_PAD_RIGHT), $level);
    }

    /**
     * {@inheritdoc}
     *
     * @since 0.1.0
     */
    public function writeH2($text, $level = self::LVL_1)
    {
        $this->writeLine('', $level);
        $this->writeLine(str_pad('', static::LINE_WIDTH, static::DEC_CHAR_1, STR_PAD_RIGHT), $level);
        $this->writeLine(str_pad(sprintf('%1$s %2$s', static::DEC_CHAR_2, $text) . ' ', static::LINE_WIDTH - 1, ' ', STR_PAD_RIGHT) . ' ', $level);
        $this->writeLine(str_pad('', static::LINE_WIDTH, static::DEC_CHAR_1, STR_PAD_RIGHT), $level);
        $this->writeLine('', $level);
    }
}
