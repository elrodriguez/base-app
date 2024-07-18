declare const Mp3Encoder: any;
interface Config {
    bitRate: number;
    sampleRate: number;
}
export declare class MP3Encoder {
    config: Config;
    mp3Encoder: typeof Mp3Encoder;
    maxSamples: number;
    samplesMono: Int16Array | null;
    dataBuffer: Int8Array[];
    constructor(config?: Config);
    clearBuffer(): void;
    appendToBuffer(buffer: Iterable<number>): void;
    floatTo16BitPCM(input: Float32Array, output: Int16Array): void;
    convertBuffer(arrayBuffer: Float32Array): Int16Array;
    encode(arrayBuffer: Float32Array): void;
    finish(): Int8Array[];
}
export {};
