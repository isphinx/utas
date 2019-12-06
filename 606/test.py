import numpy as np
import struct
import wave


audio = wave.open(
    'bird/Black-currawong/5a9fad20b67b796d2d18fe65.wav', 'rb')
rate = audio.getframerate()
num_frames = audio.getnframes()
dur = int(num_frames / rate)
fmt = "%ih" % rate
print("rate:", rate, "num frames:", num_frames, "dur:", dur, "fmt:", fmt)

for x in range(dur):
    data = audio.readframes(rate)
    data_int = struct.unpack(fmt, data)
    data_np = np.array(data_int, dtype='b')
    w = np.fft.rfft(data_np)
    freqs = np.fft.fftfreq(len(w))
    idx = np.argmax(w)
    freq = freqs[idx]
    freq_in_hz = abs(freq * rate)
    print(freq_in_hz)
