export interface AudioVisualizationOptions {
    canvas: HTMLCanvasElement;
    width: number;
    height: number;
    backgroundColor: string;
    strokeColor: string;
}
export declare type AudioVisualizationType = 'SineWave' | 'FrequencyBars' | 'FrequencyCircles';
declare type Args = Partial<Omit<AudioVisualizationOptions, 'canvas'>> & Pick<AudioVisualizationOptions, 'canvas'>;
export declare const AudioVisualizer: {
    visualizeSineWave({ canvas, backgroundColor, strokeColor, width, height, }: AudioVisualizationOptions): void;
    visualizeFrequencyBars({ canvas, backgroundColor, strokeColor, width, height, }: AudioVisualizationOptions): void;
    visualizeFrequencyCircles({ canvas, backgroundColor, strokeColor, width, height, }: AudioVisualizationOptions): void;
    hexToRgb(hex: string): {
        r: number;
        g: number;
        b: number;
    } | null;
    visualize(type: AudioVisualizationType | undefined, options: Args | undefined): void;
};
export {};
